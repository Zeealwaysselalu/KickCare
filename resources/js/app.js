import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

function openDetail(id) {
    const modal = document.getElementById('modalDetail');
    const content = document.getElementById('modalContent');

    if (!modal || !content) return;

    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';

    content.innerHTML = `
        <div class="p-12 text-center animate-pulse">
            <div class="animate-spin rounded-full h-10 w-10 border-t-2 border-b-2 border-blue-600 mx-auto"></div>
            <p class="mt-4 text-gray-500 font-roboto text-xs font-bold uppercase tracking-widest">Memuat Nota...</p>
        </div>
    `;

    fetch(`/transaksi/${id}`, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'text/html',
        }
    })
    .then(response => {
        if (!response.ok) throw new Error('Server returned ' + response.status);
        return response.text();
    })
    .then(html => {
        setTimeout(() => {
            content.innerHTML = html;
        }, 300);
    })
    .catch(error => {
        console.error('Fetch Error:', error);
        content.innerHTML = `
            <div class="p-12 text-center">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-red-50 text-red-500 rounded-full mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <p class="text-gray-800 font-bold text-sm uppercase tracking-tight">Koneksi Gagal</p>
                <p class="text-gray-500 text-xs mt-1">Gagal mengambil data dari server KickCare.</p>
                <button class="btn-close mt-4 text-blue-600 text-[10px] font-bold uppercase hover:underline">Tutup</button>
            </div>
        `;
    });
}

function closeModal() {
    const modal = document.getElementById('modalDetail');
    modal.classList.add('hidden');

    document.body.style.overflow = 'auto';
}

function formatrupiah(number) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    }).format(number).replace('Rp', 'Rp ');
}

function transaction() {
    const serviceRadios = document.querySelectorAll('input[name="service"]');
    const displayPrice = document.getElementById('display-price');
    const total = document.getElementById('total-price');
    const inputTotal = document.getElementById('input-total-price');

    if (!serviceRadios.length || !displayPrice || !total) return;

    serviceRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.checked) {
                const price = Number(this.getAttribute('data-price'));
                const formatted = formatrupiah(price);
                displayPrice.innerText = formatted;
                total.innerText = formatted;
                inputTotal.value = price;

            }
        });
    });
    const outletRadios = document.querySelectorAll('input[name="outlet_id"]');
    const displayOutlet = document.getElementById('selected-outlet');

    outletRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.checked) {
                const outletName = this.closest('label').querySelector('span').innerText;
                displayOutlet.innerText = outletName;
                displayOutlet.classList.add('text-white');
            }
        });
    });
}

document.addEventListener('click', function (e) {
    const btndetail = e.target.closest('.btn-detail');
    if (btndetail) {
        const id = btndetail.dataset.id;
        openDetail(id);
    }
    const btnclose = e.target.closest('.btn-close');
    if (btnclose) {
        closeModal();
    }
});

document.addEventListener('DOMContentLoaded', transaction);

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
        closeModal();
    }
});

window.onclick = function(event) {
    const modal = document.getElementById('modalDetail');
    if (event.target == modal) {
        closeModal();
    }
};

document.addEventListener("DOMContentLoaded", function () {
    const checked = document.querySelector('input[name="service"]:checked');
    const displayPrice = document.getElementById('display-price');
    const total = document.getElementById('total-price');
    const inputTotal = document.getElementById('input-total-price');

    if (checked) {
        const price = Number(checked.getAttribute('data-price'));
        const formatted = formatrupiah(price);

        displayPrice.innerText = formatted;
        total.innerText = formatted;
        inputTotal.value = price;
    }
});
