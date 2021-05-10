<template>
  <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Brand Table</h3>
                    <router-link class="btn btn-primary pull-right" to="/brand-create"><i class="fa fa-plus" aria-hidden="true"></i> New
                    Brand</router-link>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <th>SN</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Logo</th>
                            <th>Status</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(brand,i) in getBrands" :key="i">
                                <td>{{ ++i }}</td>
                                <td>{{ brand.name }}</td>
                                <td>{{ brand.slug }}</td>
                                <td><img :src="brand.logo" alt="" width="60px"></td>
                                <td><button class="btn btn-sm" :class="statusColor(brand.status)">{{ statusView(brand.status) }}</button></td>
                                <td>
                                    <button @click="deleteBrand(brand.id)" class="btn btn-danger btn-sm">Delete</button>
                                    <router-link :to="`brand-edit/${brand.id}`" class="btn btn-primary btn-sm">Edit</router-link>
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
        loadBrands(){
            this.$store.dispatch('loadBrands');
        },
        deleteBrand(id){
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
                   axios.delete('/api/brand/'+id)
                .then(res=>{
                    console.log(res);
                    this.loadBrands()

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
        this.loadBrands();
    },
    computed:{
        getBrands(){
            return this.$store.getters.getBrands;
        }
    }
}
</script>

<style>

</style>
