<template>
<router-view name="main" />
</template>

<script>
export default {
    mounted() {
        axios.get("/api/user") // Try to get current user otherwise Axios will redirect to login router.
            .then(res => {
                if (res.data.user.email) this.$router.push({
                    path: '/dashboard/create-post'
                });
            })
        console.log('App component mounted.')
    }
}
</script>

<style>
body {
    background-color: #eeeeee;
}

.h7 {
    font-size: 0.8rem;
}

.gedf-wrapper {
    margin-top: 0.97rem;
}

@media (min-width: 992px) {
    .gedf-main {
        padding-left: 4rem;
        padding-right: 4rem;
    }

    .gedf-card {
        margin-bottom: 2.77rem;
    }
}

@media (max-width: 992px) {
    .gedf-card {
        margin-bottom: 1.5rem;
    }
}

.gavatar {
    color: rgb(255, 255, 255);
    background-color: #c6c699;
    display: inline-block;
    font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
    font-size: 24px;
    border-radius: 50px;
    width: 50px;
    height: 50px;
    line-height: 50px;
    margin: 0px;
    text-align: center;
}
</style>
