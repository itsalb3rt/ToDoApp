<div class="container mt-5" id="app">
    <div class="row">
        <div class="col-md-12">
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-search"></i></div>
                </div>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Buscar">
            </div>
        </div>
        <div class="w-100 mt-3"></div>
        <div class="col-sm">
            <a href="<?= Assets::href('tasks/index?category=all') ?>"
               :class="['badge px-4 py-3' , category == 'all' ? 'badge-primary':'badge-light']"
            >All</a>
        </div>
        <div class="col-sm">
            <a href="<?= Assets::href('tasks/index?category=study') ?>"
               :class="['badge px-4 py-3' , category == 'study' ? 'badge-primary':'badge-light']"
            ><i class="fa fa-graduation-cap mr-2"></i>Study</a>
        </div>
        <div class="col-sm">
            <a href="<?= Assets::href('tasks/index?category=sport') ?>"
               :class="['badge px-4 py-3' , category == 'sport' ? 'badge-primary':'badge-light']"
            ><i class="fa fa-star mr-2"></i>Sport</a>
        </div>
        <div class="col-sm">
            <a href="<?= Assets::href('tasks/index?category=work') ?>"
               :class="['badge px-4 py-3' , category == 'work' ? 'badge-primary':'badge-light']"
            ><i class="fa fa-keyboard-o mr-2"></i>Work</a>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-sm">{{getDate()}}</div>
    </div>
    <div class="col-sm-12">
        <?php foreach ($tasks as $task): ?>
            <div class="card my-2">
                <div class="card-body">
                    <h5 class="card-title">
                    <span class="custom-checkbox mr-2 ml-4">
                        <input type="checkbox" class="custom-control-input"
                               <?= ($task->status == 'complete')? 'checked' : '' ?>
                               id="<?= $task->id ?>" value="<?= $task->id ?>"
                               onclick="toDoApp.setTaksComplete(this.value)">
                        <label class="custom-control-label text-success" for="<?= $task->id ?>">
                        <?php if($task->status == 'complete'): ?>
                            <i class="fa fa-check"></i>
                        <?php else: ?>
                            <i>-</i>
                        <?php endif; ?>
                        </label>
                    </span>
                        <?php if($task->status == 'complete'): ?>
                            <span ><del><?= $task->title ?></del></span>
                        <?php else: ?>
                            <span ><?= $task->title ?></span>
                        <?php endif; ?>

                    </h5>
                    <div class="card-text">
                        <?= $task->description ?>
                        <div class="text-right">
                        <span class="badge badge-ligth px-2 py-2 mr-0">
                            <?php
                            $icons = [
                                'study'=>'fa-graduation-cap',
                                'sport'=>'fa-star',
                                'work'=>'fa-keyboard-o'
                            ];
                            ?>
                        <i class="fa <?= $icons[$task->category] ?> mr-2"></i><?= strtoupper($task->category) ?>
                        </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <i class="fa fa-calendar mr-2"></i>Due before <?= $task->due_date ?>
                        </div>
                        <div class="col-12">
                            <i class="fa fa-calendar mr-2"></i>Create at <?= $task->create_at ?>
                        </div>
                        <div class="col-12">
                            <a href="<?= Assets::href('tasks/delete',$task->id) ?>"
                               class="badge px-2 py-2 badge-danger float-right"
                            ><i class="fa fa-trash mr-2"></i>Delete</a>
                        </div>
                    </div>

                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <button type="button" onclick="location.href = './add'; " class="btn btn-primary btn-lg fixed-bottom ml-3 mb-3 rounded-circle">
        <i class="fa fa-plus"></i>
    </button>
</div>
<script>
    var toDoApp = new Vue({
        mounted(){
            this.category = this.getParameterByName('category');
        },
        el:"#app",
        data:{
            category:''
        },
        methods:{
            getDate(){
                const date = new Date();
                const year = date.getFullYear();
                const month = date.getMonth()+1;
                const day = date.getDate();

                return `Today, ${day}-${month}-${year}`;
            },
            getParameterByName(name, url) {
                if (!url) url = window.location.href;
                name = name.replace(/[\[\]]/g, '\\$&');
                var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
                    results = regex.exec(url);
                if (!results) return null;
                if (!results[2]) return '';
                return decodeURIComponent(results[2].replace(/\+/g, ' '));
            },
            setTaksComplete(id){
                let route = new Route('tasks','updateStatus',[id]);
                axios({
                    url:route.route,
                    method:'PATCH',
                    headers: { 'content-type': 'application/json' },
                }).then(response=>{
                    if(response.data.status == 'success'){
                        location.reload();
                    }
                }).catch(error=>{
                    console.log(error);
                })
            }
        }
    })
</script>