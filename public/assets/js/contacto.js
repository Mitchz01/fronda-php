import { clientesApi } from './api.js';
import { createStore } from './store.js';

const CAMPOS = ['nombre', 'domicilio', 'telefono', 'correo', 'comentarios'];

// Revisión rápida antes de enviar. La validación que manda es la del servidor (ClienteValidator.php).
const reglas = {
    nombre: (v) => (!v ? 'Escribe tu nombre.' : v.length < 3 ? 'El nombre debe tener entre 3 y 120 caracteres.' : null),
    domicilio: (v) => (!v ? 'Necesitamos tu domicilio para agendar la visita.' : v.length < 5 ? 'El domicilio debe tener entre 5 y 200 caracteres.' : null),
    telefono: (v) => {
        if (!v) return 'Escribe un teléfono de contacto.';
        const digitos = v.replace(/\D/g, '').length;
        return /^\+?[\d\s()-]+$/.test(v) && digitos >= 7 && digitos <= 15 ? null : 'Ese teléfono no parece válido.';
    },
    correo: (v) => (!v ? 'Escribe tu correo electrónico.' : /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v) ? null : 'Revisa el formato del correo.'),
    comentarios: (v) => (!v ? 'Cuéntanos un poco sobre tu espacio.' : v.length < 10 ? 'Escribe al menos 10 caracteres.' : null),
};

function validar(datos) {
    return Object.fromEntries(
        CAMPOS.map((campo) => [campo, reglas[campo](datos[campo])]).filter(([, error]) => error),
    );
}

export function mountContactForm(root) {
    const form = root.querySelector('[data-contact-form]');
    const success = root.querySelector('[data-contact-success]');
    const alert = form.querySelector('[data-form-alert]');
    const alertText = form.querySelector('[data-form-alert-text]');
    const submit = form.querySelector('[type="submit"]');
    const successTitle = success.querySelector('[data-success-title]');
    const successText = success.querySelector('.success__text');

    form.noValidate = true;

    // Errores que ya vienen pintados por el servidor (envío sin JS).
    const erroresIniciales = Object.fromEntries(
        [...form.querySelectorAll('[data-error-for]')]
            .filter((el) => el.textContent.trim())
            .map((el) => [el.dataset.errorFor, el.textContent.trim()]),
    );

    const store = createStore({ estado: 'idle', errores: erroresIniciales, mensaje: null, nombre: '' });

    const leer = () => Object.fromEntries(CAMPOS.map((campo) => [campo, form.elements[campo].value.trim()]));

    const enfocarPrimerError = (errores) => {
        const primero = CAMPOS.find((campo) => errores[campo]);
        if (primero) form.elements[primero].focus();
    };

    store.subscribe(({ estado, errores, mensaje, nombre }) => {
        const enviando = estado === 'enviando';
        submit.classList.toggle('is-loading', enviando);
        submit.disabled = enviando;

        for (const campo of CAMPOS) {
            const error = errores[campo] ?? '';
            const input = form.elements[campo];
            form.querySelector(`[data-field="${campo}"]`).classList.toggle('has-error', Boolean(error));
            form.querySelector(`[data-error-for="${campo}"]`).textContent = error;
            error ? input.setAttribute('aria-invalid', 'true') : input.removeAttribute('aria-invalid');
        }

        alert.hidden = !(estado === 'error' && mensaje);
        alertText.textContent = mensaje ?? '';

        const enviado = estado === 'enviado';
        form.hidden = enviado;
        success.hidden = !enviado;

        if (enviado) {
            successTitle.textContent = nombre ? `Gracias, ${nombre}` : 'Mensaje enviado';
            successText.textContent = mensaje;
        }
    });

    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        if (store.get().estado === 'enviando') return;

        const datos = leer();
        const errores = validar(datos);

        if (Object.keys(errores).length) {
            store.set({ estado: 'error', errores, mensaje: null });
            enfocarPrimerError(errores);
            return;
        }

        store.set({ estado: 'enviando', errores: {}, mensaje: null });

        try {
            const respuesta = await clientesApi.crear({ ...datos, sitio_web: form.elements.sitio_web.value });
            store.set({ estado: 'enviado', mensaje: respuesta.mensaje, nombre: respuesta.cliente?.nombre ?? '' });
            form.reset();
            success.focus();
        } catch (error) {
            const tieneErroresDeCampo = Object.keys(error.errores ?? {}).length > 0;
            store.set({
                estado: 'error',
                errores: error.errores ?? {},
                mensaje: tieneErroresDeCampo ? null : error.message,
            });
            enfocarPrimerError(error.errores ?? {});
        }
    });

    // Al corregir un campo se borra su error.
    form.addEventListener('input', ({ target }) => {
        const { errores } = store.get();
        if (!errores[target.name]) return;

        const { [target.name]: _, ...resto } = errores;
        store.set({ errores: resto });
    });

    success.querySelector('.success__again').addEventListener('click', () => {
        store.set({ estado: 'idle', mensaje: null, nombre: '' });
        form.elements.nombre.focus();
    });
}
