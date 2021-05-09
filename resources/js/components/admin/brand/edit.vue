<template>
  <section class="content">
        <div class="row">
            <div class="col-xs-6">
                <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Brand Form</h3>
                    <router-link class="btn btn-primary pull-right" to="/brand"><i class="fa fa-list" aria-hidden="true"></i> All
                    Brand</router-link>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form @submit.prevent="updateBrand()">
                        <div class="form-group">
                            <label for="">Brand Name</label>
                            <input v-model="form.name" type="text" name="category" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div>
                        <div class="form-group">
                            <label for="logo">Brand Logo</label>
                            <input  type="file" id="logo" class="form-control" :class="{ 'is-invalid': form.errors.has('logo') }" @change="loadImage($event)">
                            <has-error :form="form" field="logo"></has-error>
                            <img width="100px" :src="form.updateLogo" alt="">
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
                status:1,
                logo:'',
                updateLogo:''
            })
        }
    },
    methods:{
        updateBrand(){
            this.form.put('/api/brand/'+this.$route.params.id)
                .then(response=>{
                    toastr.success(response.data.success)
                    this.$router.push('/brand')



                })
                .catch(err=>{
                    console.log(err);

                })

        },
        loadImage(event){
            let file=event.target.files[0];
            var reader = new FileReader();
            reader.onload = evt=>{
                this.form.updateLogo=evt.target.result
            }
            reader.readAsDataURL(file);
        },
         brand(){
            axios.get('/api/brand/'+this.$route.params.id)
                .then(response=>{
                    this.form.fill(response.data)

                })
                .catch(err=>console.log(err)
                )

        }
    },
    mounted(){
        this.brand()
    }
}
</script>

<style>

</style>
