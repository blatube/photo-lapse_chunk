export default function ({$axios, $auth}) {
  const token = $auth.getToken('local');

  if (token) {
    $axios.onRequest((config) => {
      config.headers.common.Authorization = token;
    });
  }
}
