<template>
  <section class="content">
        <div class="row">
            <div class="col-xs-6">
                <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Category Form</h3>
                    <router-link class="btn btn-primary pull-right" to="/category"><i class="fa fa-list" aria-hidden="true"></i> All
                    Category</router-link>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form @submit.prevent="addCategory()">
                        <div class="form-group">
                            <label for="">Category Name</label>
                            <input v-model="form.name" type="text" name="category" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div>
                        <div class="form-group">
                            <label for="status">Category Status</label>
                            <select name="status" id="status" class="form-control" v-model="form.status">
                                <option value="1">Active</option>
                                <option value="0">In-Active</option>
                            </select>
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
                status:1
            })
        }
    },
    methods:{
        addCategory(){
            this.form.post('/api/category')
                .then(response=>{
                    toastr.success(response.data.success)
                    this.$router.push('/category')

                })
                .catch(err=>{
                    console.log(err);

                })

        }
    }
}
</script>

<style>

</style>
