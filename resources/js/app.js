import "./bootstrap";
import Alpine from "alpinejs";

window.Alpine = Alpine;
Alpine.start();

/* ===============================
   UTILITIES
================================= */
const formatRupiah = (number) => {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        minimumFractionDigits: 0,
    })
        .format(number)
        .replace("Rp", "Rp ");
};

/* ===============================
   STATUS MODAL
================================= */
function openStatusModal() {
    const modal = document.getElementById("statusModal");

    if (!modal) return;

    modal.classList.remove("hidden");
    document.body.style.overflow = "hidden";
}

function closeStatusModal() {
    const modal = document.getElementById("statusModal");

    if (!modal) return;

    modal.classList.add("hidden");
    document.body.style.overflow = "auto";
}

window.closeStatusModal = closeStatusModal;

/* ===============================
   DETAIL MODAL
================================= */
function openDetail(id) {
    const modal = document.getElementById("modalDetail");
    const content = document.getElementById("modalContent");

    if (!modal || !content) return;

    modal.classList.remove("hidden");
    document.body.style.overflow = "hidden";

    content.innerHTML = `
        <div class="p-10 text-center">
            <div class="w-10 h-10 border-4 border-blue-500 border-t-transparent rounded-full animate-spin mx-auto"></div>
            <p class="mt-4 text-sm text-gray-500">Memuat detail transaksi...</p>
        </div>
    `;

    fetch(`/transaksi/${id}`, {
        headers: {
            "X-Requested-With": "XMLHttpRequest",
            Accept: "text/html",
        },
    })
        .then((res) => {
            if (!res.ok) {
                throw new Error("Gagal mengambil data");
            }

            return res.text();
        })
        .then((html) => {
            content.innerHTML = html;
        })
        .catch(() => {
            content.innerHTML = `
                <div class="p-10 text-center">
                    <p class="text-red-500 font-bold">
                        Gagal mengambil data transaksi
                    </p>

                    <button class="btn-close mt-4 text-blue-600 text-sm">
                        Tutup
                    </button>
                </div>
            `;
        });
}

function closeDetailModal() {
    const modal = document.getElementById("modalDetail");

    if (!modal) return;

    modal.classList.add("hidden");
    document.body.style.overflow = "auto";
}

/* ===============================
   CANCEL MODAL
================================= */
function initCancelModal() {
    const modal = document.getElementById("cancelModal");
    const form = document.getElementById("cancelForm");
    const closeBtn = document.getElementById("closeModalBtn");

    if (!modal || !form) return;

    const buttons = document.querySelectorAll(".btn-cancel");

    const openModal = (e) => {
        const actionUrl = e.currentTarget.dataset.action;

        form.action = actionUrl;

        modal.classList.remove("hidden");
        document.body.style.overflow = "hidden";
    };

    const closeModal = () => {
        modal.classList.add("hidden");

        document.body.style.overflow = "auto";

        form.reset();
        form.action = "";
    };

    buttons.forEach((btn) => {
        btn.addEventListener("click", openModal);
    });

    closeBtn?.addEventListener("click", closeModal);

    window.addEventListener("click", (e) => {
        if (e.target === modal) {
            closeModal();
        }
    });
}

/* ===============================
   CASHIER LOGIC
================================= */
function initCashierLogic() {
    const btnCheckUser = document.getElementById("btn-check-user");

    if (!btnCheckUser) return;

    const emailInput = document.getElementById("customer_email");
    const nameInput = document.getElementById("display_name");
    const statusDisplay = document.getElementById(
        "display_member_status"
    );

    const discountRateInput = document.getElementById(
        "current_discount_rate"
    );

    const serviceInputs = document.querySelectorAll(
        'input[name="service"]'
    );

    const displayPrice = document.getElementById("display-price");
    const displayDiscount =
        document.getElementById("display-discount");

    const totalPriceDisplay =
        document.getElementById("total-price");

    const inputTotalHidden =
        document.getElementById("input-total-price");

    const memberRates = {
        bronze: 0.05,
        silver: 0.1,
        gold: 0.2,
        none: 0,
    };

    function calculateCashierBilling() {
        const selected = document.querySelector(
            'input[name="service"]:checked'
        );

        const rate = parseFloat(
            discountRateInput?.value || 0
        );

        if (!selected) return;

        const price = parseInt(selected.dataset.price);

        const discountAmount = price * rate;

        const finalTotal = price - discountAmount;

        if (displayPrice) {
            displayPrice.innerText = formatRupiah(price);
        }

        if (displayDiscount) {
            displayDiscount.innerText =
                "- " + formatRupiah(discountAmount);
        }

        if (totalPriceDisplay) {
            totalPriceDisplay.innerText =
                formatRupiah(finalTotal);
        }

        if (inputTotalHidden) {
            inputTotalHidden.value = finalTotal;
        }
    }

    function resetMemberFields() {
        nameInput.value = "";

        statusDisplay.value = "BUKAN MEMBER";

        statusDisplay.classList.remove("text-blue-600");

        statusDisplay.classList.add("text-gray-400");

        discountRateInput.value = 0;
    }

    serviceInputs.forEach((input) => {
        input.addEventListener(
            "change",
            calculateCashierBilling
        );
    });

    btnCheckUser.addEventListener(
        "click",
        async () => {
            const email = emailInput.value;

            if (!email) {
                alert("Masukkan email pelanggan!");
                return;
            }

            btnCheckUser.innerHTML =
                '<span class="animate-pulse">...</span>';

            try {
                const response = await fetch(
                    `/api/find-user?email=${encodeURIComponent(
                        email
                    )}`
                );

                const data = await response.json();

                if (data.success) {
                    nameInput.value = data.name;

                    statusDisplay.value =
                        data.status_member.toUpperCase();

                    statusDisplay.classList.remove(
                        "text-gray-400"
                    );

                    statusDisplay.classList.add(
                        "text-blue-600"
                    );

                    discountRateInput.value =
                        memberRates[
                            data.status_member.toLowerCase()
                        ] || 0;
                } else {
                    alert(
                        data.message ||
                            "User tidak ditemukan"
                    );

                    resetMemberFields();
                }
            } catch (e) {
                console.error(e);

                alert(
                    "Gagal mengambil data dari server."
                );
            } finally {
                btnCheckUser.innerHTML = "Cek User";

                calculateCashierBilling();
            }
        }
    );
}

window.confirmStatusUpdate = function(selectElement, transactionId, oldStatus) {
    const newStatus = selectElement.value;

    // Jika memilih status yang krusial, munculkan konfirmasi
    if (newStatus === 'ready' || newStatus === 'cleared') {
        const message = newStatus === 'ready' 
            ? "Apakah sepatu benar-benar siap? Status 'Ready' akan mengirimkan notifikasi selesai ke pelanggan dan tidak dapat diubah kembali ke proses cuci."
            : "Status 'Cleared' berarti sepatu sudah diambil pelanggan. Transaksi akan ditutup dan tidak dapat diubah lagi.";

        if (!confirm(message)) {
            selectElement.value = oldStatus; // Balikkan ke status sebelumnya jika batal
            return;
        }
    }

    // Jika dikonfirmasi atau status biasa, jalankan fungsi update
    updateProgressStatus(selectElement, transactionId);
}

window.updateProgressStatus = function(selectElement, transactionId) {
    const newStatus = selectElement.value;
    
    selectElement.disabled = true;
    selectElement.style.opacity = '0.5';

    fetch(`/cashier/transaction/${transactionId}/update-progress`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ progress_status: newStatus })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            if (newStatus === 'ready' || newStatus === 'cleared') {
                window.location.reload(); 
            }
            console.log('Progress updated to: ' + newStatus);
        }
    })
    .catch(error => {
        alert('Gagal mengupdate status');
        console.error(error);
        window.location.reload();
    });
}

window.confirmStatusUpdate = function(selectElement, transactionId, currentStatus) {
    const nextStatus = selectElement.value;
    
    // 1. Ambil Token CSRF dari meta tag (karena ini file JS eksternal)
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    // 2. Notifikasi Konfirmasi
    const message = `Pindahkan ke ${nextStatus.toUpperCase()}?\n\nPERHATIAN: Status yang sudah diupdate tidak dapat dikembalikan ke tahap ${currentStatus.toUpperCase()} lagi!`;
    
    if (confirm(message)) {
        // Matikan select sementara agar tidak double klik
        selectElement.disabled = true;

        // 3. Jalankan Fetch
        fetch(`/transactions/${transactionId}/update-progress`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken, // Gunakan variabel yang ambil dari meta tag
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                progress_status: nextStatus
            })
        })
        .then(async response => {
            const data = await response.json();
            if (response.ok) {
                // Refresh halaman agar dropdown ter-filter (opsi lama hilang)
                window.location.reload(); 
            } else {
                alert(data.message || 'Gagal mengupdate status.');
                selectElement.value = currentStatus;
                selectElement.disabled = false;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan jaringan.');
            selectElement.value = currentStatus;
            selectElement.disabled = false;
        });
    } else {
        selectElement.value = currentStatus;
    }
}

/* ===============================
   TRANSACTION FORM
================================= */
function initTransactionForm() {
    const serviceRadios = document.querySelectorAll(
        'input[name="service"]'
    );

    const outletRadios = document.querySelectorAll(
        'input[name="outlet_id"]'
    );

    const displayPrice =
        document.getElementById("display-price");

    const displayDiscount =
        document.getElementById("display-discount");

    const totalPriceElement =
        document.getElementById("total-price");

    const inputTotal =
        document.getElementById("input-total-price");

    const inputDiscount =
        document.getElementById("input-discount");

    const displayOutlet =
        document.getElementById("selected-outlet");

    const memberStatus =
        document.getElementById("input-status-member")
            ?.value || "none";

    function updateSummary() {
        const selectedService = document.querySelector(
            'input[name="service"]:checked'
        );

        if (!selectedService) return;

        const basePrice = parseInt(
            selectedService.dataset.price
        );

        let discountPercent = 0;

        if (memberStatus === "bronze") {
            discountPercent = 0.05;
        } else if (memberStatus === "silver") {
            discountPercent = 0.1;
        } else if (memberStatus === "gold") {
            discountPercent = 0.2;
        }

        const discountAmount =
            basePrice * discountPercent;

        const finalPrice =
            basePrice - discountAmount;

        if (displayPrice) {
            displayPrice.textContent =
                formatRupiah(basePrice);
        }

        if (displayDiscount) {
            displayDiscount.textContent =
                "- " + formatRupiah(discountAmount);
        }

        if (totalPriceElement) {
            totalPriceElement.textContent =
                formatRupiah(finalPrice);
        }

        if (inputTotal) {
            inputTotal.value = finalPrice;
        }

        if (inputDiscount) {
            inputDiscount.value = discountAmount;
        }
    }

    serviceRadios.forEach((radio) => {
        radio.addEventListener("change", updateSummary);
    });

    outletRadios.forEach((radio) => {
        radio.addEventListener("change", () => {
            const name = radio
                .closest("label")
                ?.querySelector("span")?.innerText;

            if (!displayOutlet) return;

            displayOutlet.textContent = name;

            displayOutlet.classList.remove(
                "text-gray-400"
            );

            displayOutlet.classList.add(
                "text-blue-500"
            );
        });
    });

    const checked = document.querySelector(
        'input[name="service"]:checked'
    );

    if (checked) {
        updateSummary();
    }
}

/* ===============================
   ACCOUNT MODE
================================= */
window.toggleAccountMode = function (hasAccount) {
    const emailWrapper = document.getElementById(
        "email_search_wrapper"
    );

    const nameInput =
        document.getElementById("display_name");

    const statusDisplay = document.getElementById(
        "display_member_status"
    );

    const discountRateInput = document.getElementById(
        "current_discount_rate"
    );

    const emailInput =
        document.getElementById("customer_email");

    if (!nameInput) return;

    if (hasAccount) {
        emailWrapper.style.display = "block";

        nameInput.readOnly = true;

        nameInput.classList.remove("bg-gray-50");

        nameInput.classList.add("bg-gray-100");

        nameInput.placeholder = "Cek email dulu";

        nameInput.value = "";

        statusDisplay.value = "MENUNGGU PENGECEKAN";
    } else {
        emailWrapper.style.display = "none";

        nameInput.readOnly = false;

        nameInput.classList.remove("bg-gray-100");

        nameInput.classList.add("bg-gray-50");

        nameInput.placeholder =
            "Ketik nama pelanggan";

        nameInput.value = "";

        emailInput.value = "";

        statusDisplay.value = "BUKAN MEMBER";

        statusDisplay.classList.remove("text-blue-600");

        statusDisplay.classList.add("text-gray-400");

        discountRateInput.value = 0;
    }

    const checkedService = document.querySelector(
        'input[name="service"]:checked'
    );

    if (checkedService) {
        checkedService.dispatchEvent(
            new Event("change")
        );
    }
};

/* ===============================
   REPORT LOGIC (Complaint)
================================= */
function initComplaintLogic() {
    const modal = document.getElementById('complaintModal');
    if (!modal) return;

    document.addEventListener('click', (e) => {
        const btn = e.target.closest('.view-complaint-btn');
        if (btn) {
            const name = btn.getAttribute('data-name');
            const date = btn.getAttribute('data-date');
            const subject = btn.getAttribute('data-subject');
            const message = btn.getAttribute('data-message');

            document.getElementById('modal-name').innerText = name;
            document.getElementById('modal-date').innerText = date;
            document.getElementById('modal-subject').innerText = subject;
            document.getElementById('modal-message').innerText = message;

            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
    });

    window.closeComplaintModal = function() {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    };

    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeComplaintModal();
    });
}

/* ===============================
   GENERAL LOGIC
================================= */
function initGeneralLogic() {
    document.addEventListener("click", (e) => {
        const detailBtn =
            e.target.closest(".btn-detail");

        if (detailBtn) {
            openDetail(detailBtn.dataset.id);
            return;
        }

        const closeBtn =
            e.target.closest(".btn-close");

        if (closeBtn) {
            closeDetailModal();
            return;
        }

        const statusBtn =
            e.target.closest(".btn-status");

        if (statusBtn) {
            openStatusModal();
            return;
        }
    });

    window.addEventListener("keydown", (e) => {
        if (e.key === "Escape") {
            closeDetailModal();
            closeStatusModal();
        }
    });
}

/* ===============================
   INIT
================================= */
document.addEventListener(
    "DOMContentLoaded",
    () => {
        initCashierLogic();
        initTransactionForm();
        initCancelModal();
        initGeneralLogic();
        initComplaintLogic();

        const accountRadio = document.querySelector(
            'input[name="has_account"]:checked'
        );

        if (accountRadio) {
            toggleAccountMode(
                accountRadio.value === "yes"
            );
        }
    }
);
