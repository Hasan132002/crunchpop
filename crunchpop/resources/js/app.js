// --- Mobile navigation toggle -------------------------------------------
function initMobileNav() {
    const btn = document.querySelector('[data-nav-toggle]');
    const menu = document.querySelector('[data-nav-menu]');
    if (!btn || !menu) return;

    btn.addEventListener('click', () => {
        const open = menu.classList.toggle('hidden') === false;
        btn.setAttribute('aria-expanded', String(open));
        document.body.classList.toggle('overflow-hidden', open);
    });

    menu.querySelectorAll('a').forEach((a) =>
        a.addEventListener('click', () => {
            menu.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
            btn.setAttribute('aria-expanded', 'false');
        })
    );
}

// --- Auto-dismiss flash messages ----------------------------------------
function initFlash() {
    document.querySelectorAll('[data-flash]').forEach((el) => {
        setTimeout(() => {
            el.style.transition = 'opacity .5s ease, transform .5s ease';
            el.style.opacity = '0';
            el.style.transform = 'translateY(-8px)';
            setTimeout(() => el.remove(), 500);
        }, 5000);
    });
}

// --- Quantity steppers ---------------------------------------------------
function initSteppers() {
    document.querySelectorAll('[data-stepper]').forEach((wrap) => {
        const input = wrap.querySelector('input[type="number"]');
        if (!input) return;
        wrap.querySelectorAll('[data-step]').forEach((b) =>
            b.addEventListener('click', () => {
                const delta = parseInt(b.dataset.step, 10);
                const min = parseInt(input.min || '1', 10);
                const max = parseInt(input.max || '99', 10);
                let v = (parseInt(input.value, 10) || min) + delta;
                v = Math.max(min, Math.min(max, v));
                input.value = v;
                input.dispatchEvent(new Event('change', { bubbles: true }));
            })
        );
    });
}

// --- Checkout: toggle shipping fields based on fulfillment --------------
function initCheckout() {
    const radios = document.querySelectorAll('input[name="fulfillment_method"]');
    const shippingBlock = document.querySelector('[data-shipping-fields]');
    if (!radios.length || !shippingBlock) return;

    const sync = () => {
        const val = document.querySelector('input[name="fulfillment_method"]:checked')?.value;
        shippingBlock.classList.toggle('hidden', val !== 'shipping');
    };
    radios.forEach((r) => r.addEventListener('change', sync));
    sync();
}

document.addEventListener('DOMContentLoaded', () => {
    initMobileNav();
    initFlash();
    initSteppers();
    initCheckout();

    // Smooth-scroll to a target passed from the server (e.g. early-list success)
    const target = document.body.dataset.scrollTo;
    if (target) {
        document.getElementById(target)?.scrollIntoView({ behavior: 'smooth' });
    }
});
