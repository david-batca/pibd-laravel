export function initCreateForm({ entity, apiUrl, onAdd }) {
    const modal = document.getElementById(`${entity}_modal`);
    const form = document.getElementById(`${entity}_form`);

    form.addEventListener("submit", async (event) => {
        event.preventDefault();

        const formData = new FormData(form);

        try {
            const res = await fetch(apiUrl, {
                method: "POST",
                body: formData,
            });

            if (!res.ok) {
                const err = await res
                    .json()
                    .catch(() => ({ message: res.statusText }));

                throw new Error(err.message || "Eroare la server");
            }

            const response = await res.json();

            modal.checked = false;

            form.reset();

            onAdd(response);
        } catch (error) {
            alert(error.message);
        }
    });
}

window.initCreateForm = initCreateForm;

export function initEditForm({ id, entity, apiUrl, onUpdate }) {
    const modal = document.getElementById(`${entity}_edit_modal_${id}`);
    const form = document.getElementById(`${entity}_edit_form_${id}`);

    form.addEventListener("submit", async (event) => {
        event.preventDefault();

        const formData = new FormData(form);

        try {
            const res = await fetch(apiUrl, {
                method: "POST",
                body: formData,
            });

            if (!res.ok) {
                const err = await res
                    .json()
                    .catch(() => ({ message: res.statusText }));

                throw new Error(err.message || "Eroare la server");
            }

            const response = await res.json();

            modal.checked = false;

            form.reset();

            onUpdate(response);
        } catch (error) {
            alert(error.message);
        }
    });
}

window.initEditForm = initEditForm;

export function initDeleteForm({ id, entity, apiUrl, onDelete }) {
    const form = document.getElementById(`${entity}_delete_form_${id}`);

    form.addEventListener("submit", async (event) => {
        event.preventDefault();

        const formData = new FormData(form);

        try {
            const res = await fetch(apiUrl, {
                method: "POST",
                body: formData,
            });

            if (!res.ok) {
                const err = await res
                    .json()
                    .catch(() => ({ message: res.statusText }));

                throw new Error(err.message || "Eroare la server");
            }

            onDelete();
        } catch (error) {
            alert(error.message);
        }
    });
}

window.initDeleteForm = initDeleteForm;
