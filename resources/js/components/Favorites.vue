<template>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
        <div class="flex justify-center meal-card m-8 relative" v-for="meal in meals" :key="meal.name">
            <a :href="meal.slug">
                <img v-bind:src="'storage/images/' + meal.image" alt="" srcset="" />
                <p>
                    <span class="font-bold">{{meal.id +  meal.name }}</span>
                    <br />{{ meal.area }}
                </p>
            </a>
            <span id="favoriteIconBlack">
                <favorite :slug="meal.slug" :isfav="true" v-on:userFavorites="userFavorites($event)"></favorite>        
            </span>
        </div>
        
        <div v-if="!meals.length">
            No recepis found with {{ this.search }}
        </div>
    </div>
</template>

<script>
    export default {
          data() {
            return {
                meals: [],
                search: ""
            };
        },
        mounted() {
            this.userFavorites();
        },
        methods: {
            userFavorites: function() {
                axios.defaults.withCredentials = true;
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios
                        .get("/api/favorites")
                        .then(response => {
                            this.meals = response.data;
                        })
                        .catch(function (error) {
                        });
                });
            }
        }
    };
</script>