<template>
  <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Category Table</h3>
                    <router-link class="btn btn-primary pull-right" to="/category-create"><i class="fa fa-plus" aria-hidden="true"></i> New
                    Category</router-link>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <th>SN</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(category,i) in getCategories" :key="i">
                                <td>{{ ++i }}</td>
                                <td>{{ category.name }}</td>
                                <td>{{ category.slug }}</td>
                                <td><button class="btn btn-sm" :class="statusColor(category.status)">{{ statusView(category.status) }}</button></td>
                                <td>
                                    <button @click="deleteCategory(category.id)" class="btn btn-danger btn-sm">Delete</button>
                                    <router-link :to="`category-edit/${category.id}`" class="btn btn-primary btn-sm">Edit</router-link>
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
        loadCategories(){
            this.$store.dispatch('loadCategories');
        },
        deleteCategory(id){
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
                   axios.delete('/api/category/'+id)
                .then(res=>{
                    console.log(res);
                    this.loadCategory()

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
        this.loadCategories();
    },
    computed:{
        getCategories(){
            return this.$store.getters.getCategories;
        }
    }
}
</script>

<style>

</style>
