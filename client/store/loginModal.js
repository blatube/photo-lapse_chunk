export const state = () => ({
  show: false,
});

export const mutations = {
  hideLogin(state) {
    state.show = false;
  },
  showLogin(state) {
    state.show = true;
  },
};

export const getters = {
  getShow(state) {
    return state.show;
  },
};
