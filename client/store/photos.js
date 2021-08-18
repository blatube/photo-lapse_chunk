export const state = () => ({
  photos: [],
});

export const mutations = {
  async setPhotos(state, photos) {
    state.photos = photos;
  },
};

export const getters = {
  getPhotos(state) {
    return state.photos;
  },
};

export const actions = {
  async fetchPhotos({ commit }, albumId) {
    this.$axios.get(`api/photo/get-album-photos?album_id=${albumId}`).then(response => {
      commit('setPhotos', response.data.data);
    });
  },
};
