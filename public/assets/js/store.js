/**
 * Estado compartido mínimo: un objeto, un set() que mezcla cambios
 * y avisa a quien esté suscrito para volver a pintar.
 */
export function createStore(initial) {
    let state = initial;
    const listeners = new Set();

    return {
        get: () => state,

        set(patch) {
            const next = typeof patch === 'function' ? patch(state) : patch;
            state = { ...state, ...next };
            listeners.forEach((listener) => listener(state));
        },

        subscribe(listener) {
            listeners.add(listener);
            return () => listeners.delete(listener);
        },
    };
}
