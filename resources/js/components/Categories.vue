<template>
    <div>
        <div id="searchBox" class="flex mx-auto mb-16">
        <select name="categories" id="category-select" class="" @change="selectCategories(searchCategory)" v-model="searchCategory">
            
                <option value="">Category</option>
                <option :value="category.id" v-for="category in categories" :key="category.id">
                    {{ category.category }}
                </option>
        </select>       
            <svg id="searchIcon" xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="{2}"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input type="text" v-model="search" v-on:input="searchMeal" placeholder="Search recipes and more .." />

            <button type="submit" @click="searchMeal">Search</button>
        </div>
        <div class="container mx-auto m-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                <div class="flex justify-center meal-card m-8" v-for="meal in meals" :key="meal.name">
                    <a :href="meal.slug">
                        <img v-bind:src="'storage/images/' + meal.image" alt="" srcset="" />
                        <p>
                            <span class="font-bold">{{  meal.name  }}</span>
                            <br />{{ meal.area }}
                        </p>
                    </a>
                    <br>                
                </div>
                
                <div v-if="!meals.length">
                    No recepis found with {{ this.search }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Favorite from './Favorite.vue';
    export default {
  components: { Favorite },
        data() {
            return {
                categories: [],
                meals: [],
                search: "",
                searchCategory:"",
            };
        },
        mounted() {
            this.allCategories();
            this.defaultMeals();
        },
        methods: {
            searchMeal: function () {
                axios
                    .post("/api/search", {
                        search: this.search
                    })
                    .then(response => {
                        this.meals = response.data;
                    })
                    .catch(function (error) {
                    });
            },
            defaultMeals: function () {
                axios
                    .get("/api/random")
                    .then(response => {
                        this.meals = response.data;
                    })
                    .catch(function (error) {
                    });
            },
            // getting all categories
            allCategories: function () {
                axios
                    .get("/api/categories")
                    .then(response => {
                        this.categories = response.data;
                    })
                    .catch(function (error) {
                    });
            },
            // getting all categories
            selectCategories: function (searchCategory) {
                axios
                    .post("/api/search-categories", {
                        searchCategory: searchCategory
                    })
                    .then(response => {
                        this.meals = response.data;
                    })
                    .catch(function (error) {
                    });
            }
        }
    };
</script>