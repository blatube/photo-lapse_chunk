export default {
  server: {
    host: '0.0.0.0',
    port: process.env.CLIENT_PORT,
  },
  head: {
    title: 'Photo-Lapse',
    htmlAttrs: {
      lang: 'en'
    },
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: '' },
      { name: 'format-detection', content: 'telephone=no' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },
  plugins: [
    { src: '~/plugins/vuelidate', ssr: true },
  ],
  components: true,
  buildModules: [
  ],
  modules: [
    '@nuxtjs/axios',
    '@nuxtjs/auth',
    '@nuxtjs/dotenv',
    '@nuxtjs/style-resources',
    '@nuxtjs/toast',
  ],
  auth: {
    plugins: [
      { src: '~/plugins/axios', ssr: true },
    ],
    strategies: {
      local: {
        endpoints: {
          login: {
            url: '/api/auth/get-token',
            method: 'get',
            propertyName: 'data',
          },
          logout: {
            url: '/api/auth/logout',
            method: 'get'
          },
          user: {
            url: '/api/auth/profile',
            method: 'get',
            propertyName: 'data'
          },
        },
        tokenRequired: true,
      }
    },
    cookie: {
      prefix: 'auth.',
      options: {
        path: '/',
        maxAge: 31536000,
        expires: 31536000,
      }
    },
    redirect: false,
  },
  axios: {
    baseURL: process.env.API_URL,
    proxy: true,
    credentials: true,
    headers: {
      common: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
    },
  },
  toast: {
    position: 'bottom-center',
    duration: 4000,
  },
  styleResources: {
    scss: ['./assets/scss/*.scss']
  },
  build: {
  },
};
