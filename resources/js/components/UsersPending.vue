<template>
    <div class="container">
        <div class="row mt-1">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Pending Users Table</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Registered At</th>
                            </tr>
                            <tr v-for="user in users" :key="user.id">
                                <td>{{user.id}}</td>
                                <td>{{user.name}}</td>
                                <td>{{user.lastname}}</td>
                                <td>{{user.email}}</td>
                                <td>{{user.created_at | myDate}}</td>
                                <td>
                                    <a href="#" @click="editModal(user)">
                                        <i class="fa fa-edit blue">Edit</i>
                                    </a>
                                    /
                                    <a href="#" @click="deleteUser(user.id)">
                                        <i class="fa fa-trash red">Trash</i>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
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
<!--                        <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New</h5>-->
<!--                        <h5 class="modal-title" v-show="editmode" id="addNewLabel">Approve User</h5>-->
                        <h5 class="modal-title" id="addNewLabel">Approve User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
<!--                    <form @submit.prevent="editmode ? updateUser() : approveUser()">-->
                    <form @submit.prevent="approveUser()">
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.name" type="text" name="name"
                                       placeholder="First Name"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="firstname"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.lastname" type="text" name="name"
                                       placeholder="Last Name"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('lastname') }">
                                <has-error :form="form" field="lastname"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.email" type="email" name="name"
                                       placeholder="Email Address"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                <has-error :form="form" field="email"></has-error>
                            </div>

                            <div class="form-group">
                                <textarea v-model="form.bio" name="bio" id="bio"
                                       placeholder="Short bio for user (Optional)"
                                          class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                                <has-error :form="form" field="bio"></has-error>
                            </div>

                            <div class="form-group">
                                <select name="type" v-model="form.type" id="type" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                                    <option value="">Select User Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                    <option value="author">Author</option>
                                </select>
                                <has-error :form="form" field="type"></has-error>
                                <has-error :form="form" field="type"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.password" type="text" name="password" placeholder="Password" id="password"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                                <has-error :form="form" field="password"></has-error>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Approve</button>
<!--                            <button v-show="editmode" type="submit" class="btn btn-success">Approve</button>-->
<!--                            <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>-->
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Modal -->
    </div>

</template>

<script>
    export default {
        data() {
            return {
                users: {},
                form: new Form({
                    id: '',
                    name : '',
                    lastname : '',
                    email: '',
                    created_at: ''
                })
                // form: new Form({
                //     id: '',
                //     first_name : '',
                //     last_name : '',
                //     email: '',
                //     created_at: ''
                // })
            }
        },
        methods: {
            editModal(user){
                // this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(user)
                console.log(user);
            },
            approveUser(){
                console.log(this.form.id);
                this.form.post('api/approve/' + this.form.id).
                then(() => {
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide');
                    toast.fire({
                        icon: 'success',
                        title: 'User approved successfully'
                    });
                    this.$Progress.finish();
                }).
                catch(() => {

                })
            },
            // createUser(){
            //     this.$Progress.start();
            //     this.form.post('api/user').
            //     then(() => {
            //         Fire.$emit('AfterCreate');
            //         $('#addNew').modal('hide');
            //
            //         toast.fire({
            //             icon: 'success',
            //             title: 'User created successfully'
            //         });
            //
            //         this.$Progress.finish();
            //     }).
            //     catch(() => {
            //
            //     })
            // },
            loadUsers(){
                axios.get("api/userspending").then(({ data }) => (this.users = data));
            }
        },

        created() {
            this.loadUsers();
            Fire.$on('AfterCreate', () => {
                this.loadUsers();
            });
            // axios.get("api/userspending").then(({ data }) => (this.users = data));
        },
    }
</script>
