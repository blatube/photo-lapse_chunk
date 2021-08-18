export const state = () => ({
  albums: [],
});

export const mutations = {
  async setAlbums(state, albums) {
    state.albums = albums;
  },
};

export const getters = {
  getAlbums(state) {
    return state.albums;
  },
};

export const actions = {
  fetchAlbums({ commit }) {
    this.$axios.get('api/album/get-albums').then(response => {
      commit('setAlbums', response.data.data);
    });
  },
};
