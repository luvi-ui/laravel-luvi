export default function (Alpine) {
  Alpine.directive("searchable", (el, directive) => {
    if (!directive.value) handleRoot(el, Alpine);
    else if (directive.value === "item") handleItem(el, Alpine);
    else if (directive.value === "input") handleInput(el, Alpine);
    else if (directive.value === "empty") handleEmpty(el, Alpine);
  }).before("bind");
}

function handleRoot(el, Alpine) {
  Alpine.bind(el, {
    "x-id"() {
      return ["searchable-input"];
    },
    "x-data"() {
      return {
        __searchQuery: "",
        __index: [],
        __options: { keys: ["text"] },
        __filteredEls: [],
        __fuse: null,
        __search(searchQuery) {
          this.$data.__filteredEls = this.$data.__fuse
            .search(searchQuery)
            .map((searchResult) => searchResult.item.id);
        },
      };
    },
    "x-init"() {
      this.$nextTick(() => {
        // TODO: a third tag/component in searchable:item breaks the search
        // to fix this, we have to add replace inner whitespace and trim outer whitespace
        const items = Array.from(
          this.$el.querySelectorAll("[data-searchable-key]"),
        ).map((el) => ({
          id: el.dataset.searchableKey,
          text: el.textContent.replace(/\s+/g, " ").trim(),
        }));
        const index = Fuse.createIndex(this.$data.__options.keys, items);
        // initialize Fuse with the index
        this.$data.__fuse = new Fuse(items, this.$data.__options, index);
      });

      // search for all children with data-searchable-key
    },
  });
}

function handleItem(el, Alpine) {
  Alpine.bind(el, {
    "x-id"() {
      return ["searchable-item"];
    },
    ":data-searchable-key"() {
      return this.$id("searchable-item");
    },
    "x-show"() {
      return (
        this.$data.__searchQuery.length === 0 ||
        this.$data.__filteredEls.includes(this.$id("searchable-item"))
      );
    },
  });
}

function handleInput(el, Alpine) {
  Alpine.bind(el, {
    ":id"() {
      return this.$id("searchable-input");
    },
    "x-model": "__searchQuery",

    "@input"(e) {
      this.$data.__search(e.target.value);
    },
  });
}

function handleEmpty(el, Alpine) {
  Alpine.bind(el, {
    "x-show"() {
      return (
        this.$data.__searchQuery.length > 0 &&
        this.$data.__filteredEls.length === 0
      );
    },
  });
}
