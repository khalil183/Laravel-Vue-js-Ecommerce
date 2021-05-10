<template>
  <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Product Table</h3>
                    <router-link class="btn btn-primary pull-right" to="/product-create"><i class="fa fa-plus" aria-hidden="true"></i> New
                    Product</router-link>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <th>SN</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(product,i) in getProducts" :key="i">
                                <td>{{ ++i }}</td>
                                <td>{{ product.name }}</td>
                                <td>{{ product.slug }}</td>
                                <td>{{ product.image }}</td>
                                <!-- <img :src="product.image[0]" alt="Product Image" width="60px"> -->
                                <td><button class="btn btn-sm" :class="statusColor(product.status)">{{ statusView(product.status) }}</button></td>
                                <td>
                                    <button @click="deleteProduct(product.id)" class="btn btn-danger btn-sm">Delete</button>
                                    <router-link :to="`product-edit/${product.id}`" class="btn btn-primary btn-sm">Edit</router-link>
                                </td>

                            </tr>

                        </tbody>

                    </table>
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
export default {
    data(){
        return{

        }
    },
    methods:{
        loadProducts(){
            this.$store.dispatch('loadProducts');
        },
        deleteProduct(id){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                   axios.delete('/api/product/'+id)
                .then(res=>{
                    this.loadProducts()

                })
                .catch(err=>{
                    console.log(err);

                })

                }
            })
        },
        statusView(status){
            let data={0:'In-active',1:'Active'};
            return data[status];
        },
        statusColor(status){
            let data={0:'btn-danger',1:'btn-success'};
            return data[status];
        },


    },
    mounted(){
        this.loadProducts();
    },
    computed:{
        getProducts(){
            return this.$store.getters.getProducts;
        }
    }
}
</script>

<style>

</style>
