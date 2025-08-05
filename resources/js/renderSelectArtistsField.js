document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll("#combobox-multi-artists").forEach((root) => {
        const artists = JSON.parse(root.dataset.artists);
        let selected = JSON.parse(root.dataset.selected || "[]");

        const tagsWrapper = root.querySelector(".tags-wrapper-artists");
        const input = root.querySelector("#combo-input-artists");
        const list = root.querySelector("#combo-list-artists");
        const tagTpl = root.querySelector("#tag-template-artists");

        function renderTags() {
            tagsWrapper
                .querySelectorAll(".tag-artist")
                .forEach((el) => el.remove());
            selected.forEach((artist) => {
                const tpl = tagTpl.content.cloneNode(true);
                tpl.querySelector(".tag-artist-name").textContent = artist.name;
                tpl.querySelector(".tag-artist-remove").addEventListener(
                    "click",
                    () => {
                        selected = selected.filter((s) => s.id !== artist.id);
                        updateHidden();
                        renderTags();
                    }
                );
                tagsWrapper.insertBefore(tpl, input);
            });
        }

        function updateHidden() {
            root.querySelectorAll(
                'input[type=hidden][name="artist_ids[]"]'
            ).forEach((i) => i.remove());
            selected.forEach((artist) => {
                const h = document.createElement("input");
                h.type = "hidden";
                h.name = "artist_ids[]";
                h.value = artist.id;
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
            items.forEach((artist) => {
                const li = document.createElement("li");
                const a = document.createElement("a");
                a.href = "#";
                a.textContent = artist.name;
                a.className = "cursor-pointer";
                a.addEventListener("click", (e) => {
                    e.preventDefault();
                    if (!selected.some((s) => s.id === artist.id)) {
                        selected.push(artist);
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

        function filterArtists() {
            const q = input.value.trim().toLowerCase();
            const pool = artists.filter(
                (s) => !selected.some((sel) => sel.id === s.id)
            );
            return q === ""
                ? pool
                : pool.filter((s) => s.name.toLowerCase().includes(q));
        }

        input.addEventListener("focus", () => {
            renderList(filterArtists());
            list.classList.remove("hidden");
        });
        input.addEventListener("input", () => {
            renderList(filterArtists());
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
