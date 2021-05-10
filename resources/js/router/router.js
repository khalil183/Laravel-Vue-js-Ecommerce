import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

import Admin from '../components/admin/Dashboard'
// category component
import Category from '../components/admin/category/index'
import createCategory from '../components/admin/category/create'
import editCategory from '../components/admin/category/edit'

// brand component
import Brand from '../components/admin/brand/index'
import createBrand from '../components/admin/brand/create'
import editBrand from '../components/admin/brand/edit'

import Product from '../components/admin/product/index'
import createProduct from '../components/admin/product/create'
import editProduct from '../components/admin/product/edit'



const routes=[
    { path:'/admin-dashboard',component:Admin },

    // category route
    { path:'/category',component:Category },
    { path:'/category-create',component: createCategory },
    { path:'/category-edit/:id',component: editCategory },

    // brand route
    { path:'/brand',component:Brand },
    { path:'/brand-create',component: createBrand },
    { path:'/brand-edit/:id',component: editBrand },

    // product route
    { path:'/product',component:Product },
    { path:'/product-create',component: createProduct },
    { path:'/product-edit/:id',component: editProduct },


    // any route
    { path:"*",component:Admin }
]

export default new VueRouter({
    routes,
    mode:'history'
})
