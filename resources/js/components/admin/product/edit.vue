<template>
  <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Product Form</h3>
                    <router-link class="btn btn-primary pull-right" to="/product"><i class="fa fa-list" aria-hidden="true"></i> All
                    Product</router-link>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form @submit.prevent="updateProduct()">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Product Name</label>
                                    <input v-model="form.name" type="text" name="name" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                    <has-error :form="form" field="name"></has-error>
                                </div>
                            </div>
                            <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="">Product Code</label>
                                    <input v-model="form.code" type="text" name="code" class="form-control" :class="{ 'is-invalid': form.errors.has('code') }">
                                    <has-error :form="form" field="code"></has-error>
                                </div>
                            </div>
                            <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="category">Category</label>
                                    <select name="category" id="category" class="form-control" v-model="form.category_id"
                                    :class="{ 'is-invalid': form.errors.has('category_id') }">
                                        <option value="">Select Category</option>
                                        <option :value="category.id" v-for="(category,i) in getCategories" :key="i">{{ category.name }}</option>
                                    </select>
                                    <has-error :form="form" field="category_id"></has-error>
                                </div>
                            </div>
                            <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="brand">Brand</label>
                                    <select name="brand" id="brand" class="form-control" v-model="form.brand_id"
                                    :class="{ 'is-invalid': form.errors.has('brand_id') }">
                                        <option value="">Select Brand</option>
                                        <option :value="brand.id" v-for="(brand,i) in getBrands" :key="i">{{ brand.name }}</option>
                                    </select>
                                    <has-error :form="form" field="brand_id"></has-error>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Product Quantity</label>
                                    <input v-model="form.qty" type="number" name="qty" class="form-control" :class="{ 'is-invalid': form.errors.has('qty') }" placeholder="0">
                                    <has-error :form="form" field="qty"></has-error>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Buying Price</label>
                                    <input v-model="form.buying_price" type="text" name="buying_price" class="form-control" :class="{ 'is-invalid': form.errors.has('buying_price') }" placeholder="100">
                                    <has-error :form="form" field="buying_price"></has-error>
                                </div>
                            </div>
                            <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="">Selling Price</label>
                                    <input v-model="form.selling_price" type="text" name="selling_price" class="form-control" :class="{ 'is-invalid': form.errors.has('selling_price') }" placeholder="100">
                                    <has-error :form="form" field="selling_price"></has-error>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="newImages">Product Images</label>
                                    <input multiple  type="file" id="newImages" class="form-control" :class="{ 'is-invalid': form.errors.has('newImages') }" @change="loadImage($event)">
                                    <has-error :form="form" field="newImages"></has-error>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Category Status</label>
                                    <select name="status" id="status" class="form-control" v-model="form.status">
                                        <option value="1">Active</option>
                                        <option value="0">In-Active</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <img width="100px" style="margin-left:10px" :src="image" v-for="(image,i) in form.newImages" :key="i" alt="Product Images">
                            </div>
                        </div>

                        <button class="btn btn-success">Submit</button>
                    </form>
                </div>
                <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
</template>

<script>
import Form from 'vform'
import { HasError } from 'vform/src/components/bootstrap5'
export default {
    components:{
        HasError
    },
    data(){
        return {
            form:new Form({
                name:'',
                code:'',
                qty:'',
                brand_id:'',
                category_id:'',
                buying_price:'',
                selling_price:'',
                status:1,
                images:'',
                newImages:[]
            })
        }
    },
    methods:{
        updateProduct(){
            this.form.put('/api/product/'+this.$route.params.id)
                .then(response=>{
                    console.log(response);

                    // toastr.success(response.data.success)
                    // this.$router.push('/product')

                })
                .catch(err=>{
                    console.log(err);

                })

        },
        loadImage(event){
            this.form.newImages=[]
            for(let i=0;i<event.target.files.length;i++){
                let file=event.target.files[i];
                var reader = new FileReader();
                reader.onload = evnt=>{
                    this.form.newImages.push(evnt.target.result)
                }
                reader.readAsDataURL(file);
            }
        },
        loadCategories(){
            this.$store.dispatch('loadCategories');
        },
        loadBrands(){
            this.$store.dispatch('loadBrands');
        },
        loadProduct(){
            axios.get('/api/product/'+this.$route.params.id)
                .then(response=>{
                    this.form.fill(response.data)

                })
                .catch(err=>console.log(err)
                )
        }

    },
    mounted(){
        this.loadCategories();
        this.loadBrands();
        this.loadProduct();
    },
    computed:{
        getCategories(){
           return this.$store.getters.getCategories;
        },
        getBrands(){
           return this.$store.getters.getBrands;
        },

    }
}
</script>

<style>

</style>
