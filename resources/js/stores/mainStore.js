import { defineStore } from "pinia";

export const useMainStore = defineStore("mainStates", {
    state: () => ({
        counter: 0,
        isToggled: false,
        settings: {},
    }),
    getters: {
        doubleCount: (state) => {
            state.counter * 2;
        },
    }
});
