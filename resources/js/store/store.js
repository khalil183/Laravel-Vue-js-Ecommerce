import axios from 'axios'
import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store=new Vuex.Store({
    state:{
        categories:[],
        posts:[],
        brands:[],
        count:20
    },
    getters:{
        getCategory(state){
            return state.categories;
        },
         getBrand(state){
            return state.brands;
        },


    },
    actions:{
        loadCategory(context){
            axios.get('/api/category/')
                .then(response=>{
                    context.commit('loadCategory',response.data)

                })
                .catch(err=>{
                    console.log(err);

                })
        },

        loadBrand(context){
            axios.get('/api/brand/')
                .then(response=>{
                    context.commit('loadBrand',response.data)

                })
                .catch(err=>{
                    console.log(err);

                })
        },

    },
    mutations:{
        loadCategory(state,payload){
            state.categories=payload;
        },
        loadBrand(state,payload){
            state.brands=payload;
        },

    }
})

export default store;
