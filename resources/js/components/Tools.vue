<template>

    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Tool Tracking</h3>

                        <div class="card-tools">
                            <button class="btn btn-success"
                                    @click="newModal"
                                    data-target="#addNew">Add New
                                <i class="fas fa-user-plus fa-fw"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>Tool Type</th>
                                <th>Tool A/N</th>
                                <th>Arrived</th>
                                <th>CCD</th>
                                <th>Invoice</th>
                                <th>Location</th>
                                <th>Circ Hrs</th>
                                <th>Comment</th>
                            </tr>
                            <tr v-for="tool in tools.data" :key="tool.id">
                                <td>{{tool.Id}}</td>
                                <td>{{tool.Item}}</td>
                                <td>{{tool.Asset}}</td>
                                <td>{{tool.Arrived}}</td>
                                <td>{{tool.CCD }}</td>
                                <td>{{tool.Invoice }}</td>
                                <td>{{tool.ItemStatus }}</td>
                                <td>{{tool.Circulation }}</td>
                                <td>{{tool.Comment }}</td>
                                <td>
                                    <a href="#" @click="editModal(tool)">
                                        <i class="fa fa-edit blue">Edit</i>
                                    </a>
                                </td>
                            </tr>
                            </tbody></table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add Tool</h5>
                        <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update Tool</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
<!--                    <form @submit.prevent="editmode ? updateTool() : createTool()">-->
<!--                        <div class="modal-body">-->
<!--                            <div class="form-group">-->
<!--                                <input v-model="form.name" type="text" name="name"-->
<!--                                       placeholder="Name"-->
<!--                                       class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">-->
<!--                                <has-error :form="form" field="name"></has-error>-->
<!--                            </div>-->

<!--                            <div class="form-group">-->
<!--                                <input v-model="form.email" type="email" name="name"-->
<!--                                       placeholder="Email Address"-->
<!--                                       class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">-->
<!--                                <has-error :form="form" field="email"></has-error>-->
<!--                            </div>-->

<!--                            <div class="form-group">-->
<!--                                <textarea v-model="form.bio" name="bio" id="bio"-->
<!--                                          placeholder="Short bio for user (Optional)"-->
<!--                                          class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>-->
<!--                                <has-error :form="form" field="bio"></has-error>-->
<!--                            </div>-->

<!--                            <div class="form-group">-->
<!--                                <select name="type" v-model="form.type" id="type" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">-->
<!--                                    <option value="">Select User Role</option>-->
<!--                                    <option value="admin">Admin</option>-->
<!--                                    <option value="user">Standard User</option>-->
<!--                                    <option value="author">Author</option>-->
<!--                                </select>-->
<!--                                <has-error :form="form" field="type"></has-error>-->
<!--                            </div>-->

<!--                            <div class="form-group">-->
<!--                                <input v-model="form.password" type="password" name="password" id="password"-->
<!--                                       class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">-->
<!--                                <has-error :form="form" field="password"></has-error>-->
<!--                            </div>-->

<!--                        </div>-->
<!--                        <div class="modal-footer">-->
<!--                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
<!--                            <button v-show="editmode" type="submit" class="btn btn-success">Update</button>-->
<!--                            <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>-->
<!--                        </div>-->
<!--                    </form>-->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                editmode: false,
                tools: {},
                form: new Form({
                    Id: '',
                    Item: '',
                    Asset: '',
                    Arrived: '',
                    CCD: '',
                    Invoice: '',
                    ItemStatus: '',
                    Circulation: '',
                    Comment: ''
                })
            }
        },
        methods: {
            editModal(tool){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(tool)
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
            loadTools(){
                axios.get("api/tool").then(({ data }) => (this.tools = data));
            },
            created() {
                this.loadTools();
            }
        },
    }
</script>

<style scoped>

</style>
