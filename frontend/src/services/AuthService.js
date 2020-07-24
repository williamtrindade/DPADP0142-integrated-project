export default {
    login: async (email, password) => {
        this.$http
            .post('/oauth/token', {
                grant_type: 'password',
                client_id: process.env.APP_VUE_CLIENT_ID,
                client_secret: process.env.APP_VUE_CLIENT_SECRET,
                username: email,
                password: password
            })
            .then(resp => {
                console.log(resp)
                // const token = resp.data
                // localStorage.setItem("token", resp.data.data.me.token);
                // localStorage.setItem(
                //     "account_id",
                //     resp.data.data.me.account_id
                // );
                // return token;
            })
            .catch(err => {
                console.log(err)
            })
    }
}
