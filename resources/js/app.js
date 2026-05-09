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
   CASHIER DASHBOARD LOGIC
   (Hanya berjalan di halaman Kasir)
================================= */
function initCashierLogic() {
    const btnCheckUser = document.getElementById("btn-check-user");
    
    // GUARD: Jika elemen ini tidak ada, berarti bukan halaman kasir
    if (!btnCheckUser) return;

    const emailInput = document.getElementById("customer_email");
    const nameInput = document.getElementById("display_name");
    const statusDisplay = document.getElementById("display_member_status");
    const discountRateInput = document.getElementById("current_discount_rate");
    const serviceInputs = document.querySelectorAll('input[name="service"]');

    // UI Summary Elements
    const displayPrice = document.getElementById("display-price");
    const displayDiscount = document.getElementById("display-discount");
    const totalPriceDisplay = document.getElementById("total-price");
    const inputTotalHidden = document.getElementById("input-total-price");

    const memberRates = { gold: 0.20, silver: 0.10, bronze: 0.05, none: 0 };

    // 1. Fungsi Kalkulasi Billing Kasir
    const calculateCashierBilling = () => {
        const selected = document.querySelector('input[name="service"]:checked');
        const rate = parseFloat(discountRateInput?.value || 0);
        
        if (selected) {
            const price = parseInt(selected.dataset.price);
            const discountAmount = price * rate;
            const finalTotal = price - discountAmount;

            if (displayPrice) displayPrice.innerText = formatRupiah(price);
            if (displayDiscount) displayDiscount.innerText = '- ' + formatRupiah(discountAmount);
            if (totalPriceDisplay) totalPriceDisplay.innerText = formatRupiah(finalTotal);
            if (inputTotalHidden) inputTotalHidden.value = finalTotal;
        }
    };

    // 2. Event Listener Service
    serviceInputs.forEach(input => {
        input.addEventListener('change', calculateCashierBilling);
    });

    // 3. Event Listener Cek User via Email
    btnCheckUser.addEventListener('click', async () => {
        const email = emailInput.value;
        if (!email) return alert('Masukkan email pelanggan!');

        btnCheckUser.innerHTML = '<span class="animate-pulse">...</span>';
        
        try {
            const response = await fetch(`/api/find-user?email=${encodeURIComponent(email)}`);
            const data = await response.json();

            if (data.success) {
                nameInput.value = data.name;
                statusDisplay.value = data.status_member.toUpperCase();
                statusDisplay.classList.remove('text-gray-400');
                statusDisplay.classList.add('text-blue-600');
                discountRateInput.value = memberRates[data.status_member.toLowerCase()] || 0;
            } else {
                alert(data.message || 'User tidak ditemukan');
                resetMemberFields();
            }
        } catch (e) {
            console.error("Fetch Error:", e);
            alert('Gagal mengambil data dari server.');
        } finally {
            btnCheckUser.innerHTML = 'Cek User';
            calculateCashierBilling();
        }
    });

    function resetMemberFields() {
        nameInput.value = "";
        statusDisplay.value = "BUKAN MEMBER";
        statusDisplay.classList.replace('text-blue-600', 'text-gray-400');
        discountRateInput.value = 0;
    }
}

/**
 * Toggle Mode: Member vs Guest
 * Dibuat Global (window) agar bisa diakses dari atribut onchange di Blade
 */
window.toggleAccountMode = function(hasAccount) {
    const emailWrapper = document.getElementById('email_search_wrapper');
    const nameInput = document.getElementById('display_name');
    const statusDisplay = document.getElementById('display_member_status');
    const discountRateInput = document.getElementById('current_discount_rate');
    const emailInput = document.getElementById('customer_email');

    if (!nameInput) return;

    if (hasAccount) {
        emailWrapper.style.display = 'block';
        nameInput.readOnly = true;
        nameInput.classList.replace('bg-gray-50', 'bg-gray-100');
        nameInput.placeholder = "Cek email dulu";
        nameInput.value = "";
        statusDisplay.value = "MENUNGGU PENGECEKAN";
    } else {
        emailWrapper.style.display = 'none';
        nameInput.readOnly = false;
        nameInput.classList.replace('bg-gray-100', 'bg-gray-50');
        nameInput.placeholder = "Ketik nama pelanggan";
        nameInput.value = "";
        emailInput.value = "";
        
        statusDisplay.value = "BUKAN MEMBER";
        statusDisplay.classList.replace('text-blue-600', 'text-gray-400');
        discountRateInput.value = 0;
    }

    // Trigger hitung ulang setelah ganti mode
    const checkedService = document.querySelector('input[name="service"]:checked');
    if (checkedService) {
        checkedService.dispatchEvent(new Event('change'));
    }
};

/* ===============================
   GENERAL TRANSAKSI (USER BIASA)
   & MODAL LOGIC
================================= */
function initGeneralLogic() {
    document.addEventListener("click", (e) => {
        const detailBtn = e.target.closest(".btn-detail");
        if (detailBtn) openDetail(detailBtn.dataset.id);

        const closeBtn = e.target.closest(".btn-close");
        if (closeBtn) closeDetailModal();
    });

    const cancelModal = document.getElementById("cancelModal");
    const cancelButtons = document.querySelectorAll(".btn-cancel");
    if (cancelModal) {
        cancelButtons.forEach(btn => {
            btn.addEventListener("click", (e) => {
                const form = document.getElementById("cancelForm");
                form.action = e.currentTarget.dataset.action;
                cancelModal.classList.remove("hidden");
                document.body.style.overflow = "hidden";
            });
        });
    }
}

function openDetail(id) {
    const modal = document.getElementById("modalDetail");
    const content = document.getElementById("modalContent");
    if (!modal) return;

    modal.classList.remove("hidden");
    document.body.style.overflow = "hidden";

    fetch(`/transaksi/${id}`, {
        headers: { "X-Requested-With": "XMLHttpRequest", Accept: "text/html" },
    })
    .then(res => res.text())
    .then(html => { content.innerHTML = html; })
    .catch(() => { content.innerHTML = '<p class="p-4 text-red-500">Gagal memuat data.</p>'; });
}

function closeDetailModal() {
    const modal = document.getElementById("modalDetail");
    if (modal) {
        modal.classList.add("hidden");
        document.body.style.overflow = "auto";
    }
}

/* ===============================
   INITIALIZATION
================================= */
document.addEventListener("DOMContentLoaded", () => {
    initCashierLogic();
    initGeneralLogic();   
    
    const accountRadio = document.querySelector('input[name="has_account"]:checked');
    if (accountRadio) {
        toggleAccountMode(accountRadio.value === 'yes');
    }
});