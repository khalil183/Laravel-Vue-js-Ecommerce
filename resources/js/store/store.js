import axios from 'axios'
import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store=new Vuex.Store({
    state:{
        categories:[],
        products:[],
        brands:[],
        count:20
    },
    getters:{
        getCategories(state){
            return state.categories;
        },
         getBrands(state){
            return state.brands;
        },
        getProducts(state){
            return state.products;
        },



    },
    actions:{
        loadCategories(context){
            axios.get('/api/category/')
                .then(response=>{
                    context.commit('loadCategories',response.data)

                })
                .catch(err=>{
                    console.log(err);

                })
        },

        loadBrands(context){
            axios.get('/api/brand/')
                .then(response=>{
                    context.commit('loadBrands',response.data)

                })
                .catch(err=>{
                    console.log(err);

                })
        },
        loadProducts(context){
            axios.get('/api/product/')
                .then(response=>{
                    context.commit('loadProducts',response.data)

                })
                .catch(err=>{
                    console.log(err);

                })
        },


    },
    mutations:{
        loadCategories(state,payload){
            state.categories=payload;
        },
        loadBrands(state,payload){
            state.brands=payload;
        },
        loadProducts(state,payload){
            state.products=payload;
        },


    }
})

export default store;
