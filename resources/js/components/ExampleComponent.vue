<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                        <p></p>
                        <li v-for="notification in notifications">{{ notification.message }}</li>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user'],
        data() {
            return {
                notifications: []
            }
        },
        mounted() {
            console.log('Component mounted.');
            Echo.private('App.User.' + this.user)
                .notification((notification) => {
                    console.log(notification);
                    // Notification
                    if (Notification.permission === "granted") {
                        // If it's okay let's create a notification
                        this.notifications.push(notification);
                        let not = new Notification(notification.message, {
                            icon: 'http://logonoid.com/images/laravel-logo.png'
                        });
                        not.onclick = () => {
                            window.open('https://schoolofnet.com');
                        }
                    }

                    // Otherwise, we need to ask the user for permission
                    else if (Notification.permission !== 'denied') {
                        Notification.requestPermission(function (permission) {
                            // If the user accepts, let's create a notification
                            if (permission === "granted") {
                                this.notifications.push(notification);
                                let not = new Notification(notification.message, {
                                    icon: 'http://logonoid.com/images/laravel-logo.png'
                                });
                                not.onclick = () => {
                                    window.open('https://schoolofnet.com');
                                }
                            }
                        });
                    }
                })
        }
    }
</script>
