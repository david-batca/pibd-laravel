document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll("#combobox-multi-songs").forEach((root) => {
        const songs = JSON.parse(root.dataset.songs);
        let selected = JSON.parse(root.dataset.selected || "[]");

        const tagsWrapper = root.querySelector(".tags-wrapper-songs");
        const input = root.querySelector("#combo-input-songs");
        const list = root.querySelector("#combo-list-songs");
        const tagTpl = root.querySelector("#tag-template-songs");

        function renderTags() {
            tagsWrapper
                .querySelectorAll(".tag-song")
                .forEach((el) => el.remove());
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
                tagsWrapper.insertBefore(tpl, input);
            });
        }

        function updateHidden() {
            root.querySelectorAll(
                'input[type=hidden][name="song_ids[]"]'
            ).forEach((i) => i.remove());
            selected.forEach((song) => {
                const h = document.createElement("input");
                h.type = "hidden";
                h.name = "song_ids[]";
                h.value = song.id;
                root.appendChild(h);
            });
        }

        function renderList(items) {
            list.innerHTML = "";
            if (items.length === 0) {
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

        input.addEventListener("focus", () => {
            renderList(filterSongs());
            list.classList.remove("hidden");
        });
        input.addEventListener("input", () => {
            renderList(filterSongs());
            list.classList.remove("hidden");
        });
        document.addEventListener("click", (e) => {
            if (!root.contains(e.target)) {
                list.classList.add("hidden");
            }
        });

        renderTags();
        updateHidden();
    });
});
