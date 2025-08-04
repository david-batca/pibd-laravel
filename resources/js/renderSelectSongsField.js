document.addEventListener("DOMContentLoaded", () => {
    const rootMulti = document.getElementById("combobox-multi-songs");
    if (!rootMulti) return;

    const songs = JSON.parse(rootMulti.dataset.songs);
    const tagsWrapper = rootMulti.querySelector(".tags-wrapper-songs");
    const input = rootMulti.querySelector("#combo-input-songs");
    const list = rootMulti.querySelector("#combo-list-songs");
    const tagTpl = rootMulti.querySelector("#tag-song-template");
    let selected = [];

    function renderTags() {
        // Șterg toate tag-urile existente
        tagsWrapper
            .querySelectorAll(".tag-song")
            .forEach((tagEl) => tagEl.remove());
        // Re-creez tag-urile în ordine inversă (opțional) sau direct
        selected.forEach((song) => {
            const tpl = tagTpl.content.cloneNode(true);
            tpl.querySelector(".tag-song-name").textContent = song.name;
            tpl.querySelector(".tag-song-remove").addEventListener(
                "click",
                () => {
                    selected = selected.filter((s) => s.id !== song.id);
                    updateHidden();
                    renderTags();
                }
            );
            // Prepend în wrapper
            tagsWrapper.insertBefore(tpl, input);
        });
    }

    function updateHidden() {
        // Șterg vechile input-uri ascunse
        rootMulti
            .querySelectorAll('input[type=hidden][name="song_ids[]"]')
            .forEach((i) => i.remove());
        // Creez câte un <input hidden> pentru fiecare ID
        selected.forEach((song) => {
            const h = document.createElement("input");
            h.type = "hidden";
            h.name = "song_ids[]";
            h.value = song.id;
            rootMulti.appendChild(h);
        });
    }

    function renderList(items) {
        list.innerHTML = "";
        if (!items.length) {
            const li = document.createElement("li");
            li.className = "opacity-50 cursor-default";
            li.textContent = "Nu există rezultate";
            list.appendChild(li);
            return;
        }
        items.forEach((song) => {
            const li = document.createElement("li");
            const a = document.createElement("a");
            a.href = "#";
            a.textContent = song.name;
            a.className = "cursor-pointer";
            a.addEventListener("click", (e) => {
                e.preventDefault();
                if (!selected.some((s) => s.id === song.id)) {
                    selected.push(song);
                    updateHidden();
                    renderTags();
                }
                input.value = "";
                list.classList.add("hidden");
            });
            li.appendChild(a);
            list.appendChild(li);
        });
    }

    function filterSongs() {
        const q = input.value.trim().toLowerCase();
        const pool = songs.filter(
            (s) => !selected.some((sel) => sel.id === s.id)
        );
        return q === ""
            ? pool
            : pool.filter((s) => s.name.toLowerCase().includes(q));
    }

    // Evenimente
    input.addEventListener("focus", () => {
        renderList(filterSongs());
        list.classList.remove("hidden");
    });
    input.addEventListener("input", () => {
        renderList(filterSongs());
        list.classList.remove("hidden");
    });
    document.addEventListener("click", (e) => {
        if (!rootMulti.contains(e.target)) {
            list.classList.add("hidden");
        }
    });

    // Initial tag rendering
    renderTags();
});
