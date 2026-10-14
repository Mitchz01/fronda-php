const meta = (name) => document.querySelector(`meta[name="${name}"]`)?.content ?? '';

const baseUrl = meta('base-url').replace(/\/$/, '');

export class ApiError extends Error {
    constructor(message, status, errores = {}) {
        super(message);
        this.status = status;
        this.errores = errores;
    }
}

async function post(path, data) {
    let response;

    try {
        response = await fetch(`${baseUrl}${path}`, {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json',
                Accept: 'application/json',
                'X-CSRF-Token': meta('csrf-token'),
            },
            body: JSON.stringify(data),
        });
    } catch {
        throw new ApiError('Sin conexión. Revisa tu internet e intenta de nuevo.', 0);
    }

    const body = await response.json().catch(() => ({}));

    if (!response.ok || !body.ok) {
        throw new ApiError(body.mensaje ?? 'Algo salió mal. Intenta de nuevo.', response.status, body.errores ?? {});
    }

    return body;
}

export const clientesApi = {
    crear: (datos) => post('/api/clientes', datos),
};
