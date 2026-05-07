import "./bootstrap";
import Alpine from "alpinejs";

window.Alpine = Alpine;
Alpine.start();

/* ===============================
   UTILITIES
================================= */
function formatRupiah(number) {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        minimumFractionDigits: 0,
    })
        .format(number)
        .replace("Rp", "Rp ");
}

/* ===============================
   MODAL DETAIL
================================= */
function openDetail(id) {
    const modal = document.getElementById("modalDetail");
    const content = document.getElementById("modalContent");

    if (!modal || !content) return;

    modal.classList.remove("hidden");
    document.body.style.overflow = "hidden";

    fetch(`/transaksi/${id}`, {
        headers: {
            "X-Requested-With": "XMLHttpRequest",
            Accept: "text/html",
        },
    })
        .then((res) => {
            if (!res.ok) throw new Error(res.status);
            return res.text();
        })
        .then((html) => {
            content.innerHTML = html;
        })
        .catch(() => {
            content.innerHTML = `
            <div class="p-12 text-center">
                <p class="text-red-500 font-bold">Gagal mengambil data</p>
                <button class="btn-close mt-4 text-blue-600 text-xs">Tutup</button>
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
   MODAL CANCEL
================================= */
function initCancelModal() {
    const modal = document.getElementById("cancelModal");
    const form = document.getElementById("cancelForm");
    const closeBtn = document.getElementById("closeModalBtn");
    const buttons = document.querySelectorAll(".btn-cancel");

    if (!modal || !form) return;

    // 1. Fungsi Buka Modal
    const openModal = (e) => {
        const btn = e.currentTarget;

        // Ambil URL aman dari atribut data-action yang digenerate Blade
        const actionUrl = btn.dataset.action;

        form.action = actionUrl;
        modal.classList.remove("hidden");
        document.body.style.overflow = "hidden"; // Kunci scroll layar belakang
    };

    // 2. Fungsi Tutup Modal
    const closeModal = () => {
        modal.classList.add("hidden");
        document.body.style.overflow = "auto"; // Kembalikan scroll
        form.reset();
        form.action = ""; // Bersihkan action demi keamanan
    };

    // 3. Pemasangan Event Listener
    buttons.forEach((btn) => {
        btn.addEventListener("click", openModal);
    });

    closeBtn?.addEventListener("click", closeModal);

    window.addEventListener("click", (e) => {
        if (e.target === modal) closeModal();
    });
}

/* ===============================
   TRANSACTION FORM
================================= */
function initTransactionForm() {
    const serviceRadios = document.querySelectorAll('input[name="service"]');
    const outletRadios = document.querySelectorAll('input[name="outlet_id"]');

    const displayPrice = document.getElementById("display-price");
    const total = document.getElementById("total-price");
    const inputTotal = document.getElementById("input-total-price");
    const displayOutlet = document.getElementById("selected-outlet");
    const displayDiscount = document.getElementById("discount");
    const inputDiscount = document.getElementById("input-discount");
    const inputStatusMember = document.getElementById("input-status-member");

    if (!serviceRadios.length) return;

    // update harga
    serviceRadios.forEach((radio) => {
        radio.addEventListener("change", () => {
            const price = Number(radio.dataset.price);
            const formatted = formatRupiah(price);

            displayPrice.textContent = formatted;
            total.textContent = formatted;
            if (inputTotal) inputTotal.value = price;
        });
    });

    // update outlet
    outletRadios.forEach((radio) => {
        radio.addEventListener("change", () => {
            const name = radio
                .closest("label")
                ?.querySelector("span")?.innerText;
            if (displayOutlet) {
                displayOutlet.textContent = name;
                displayOutlet.classList.add("text-white");
            }
        });
    });

    // auto trigger kalau sudah ada yang dipilih (dari URL)
    const checked = document.querySelector('input[name="service"]:checked');
    if (checked) checked.dispatchEvent(new Event("change"));
}

/* ===============================
   GLOBAL EVENTS
================================= */
function initGlobalEvents() {
    document.addEventListener("click", (e) => {
        const detailBtn = e.target.closest(".btn-detail");
        if (detailBtn) openDetail(detailBtn.dataset.id);

        const closeBtn = e.target.closest(".btn-close");
        if (closeBtn) closeDetailModal();
    });

    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") {
            // Tutup Detail Modal
            closeDetailModal();

            // Tutup Cancel Modal (jika sedang terbuka)
            const cancelModal = document.getElementById("cancelModal");
            if (cancelModal && !cancelModal.classList.contains("hidden")) {
                cancelModal.classList.add("hidden");
                document.getElementById("cancelForm")?.reset();
                document.body.style.overflow = "auto";
            }
        }
    });
}

/* ===============================
   INIT
================================= */
document.addEventListener("DOMContentLoaded", () => {
    initTransactionForm();
    initCancelModal();
    initGlobalEvents();
});
