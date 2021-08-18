export const actions = {
  async nuxtServerInit ({ commit }) {
    const [
      albums,
    ] = await Promise.all([
      this.$axios.get('api/album/get-albums'),
    ]);

    commit('albums/setAlbums', albums.data.data);
  }
};
