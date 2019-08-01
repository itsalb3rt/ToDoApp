<div class="container mt-5">
    <div class="row">
        <div class="col-sm-12 justify-content-md-center" style="text-align: center"><h3>New task</h3></div>
        <div class="col-sm-12 mt-5">
            <form method="POST" action="<?= Assets::href('tasks/createTask') ?>">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Do someting">
                </div>
                <hr>
                <p>Choose Category</p>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="category" id="radio1" value="study" checked>
                    <label class="form-check-label mr-4" for="radio1">
                        Study
                    </label>
                    <input class="form-check-input" type="radio" name="category" id="radio2" value="sport">
                    <label class="form-check-label mr-4" for="radio2">
                        Sport
                    </label>
                    <input class="form-check-input" type="radio" name="category" id="radio3" value="work">
                    <label class="form-check-label" for="radio3">
                        Work
                    </label>
                </div>
                <hr>
                <div>
                    <p>Set the due date to do this task</p>
                </div>
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                    <input type="date" class="form-control" name="duedate" id="duedate" placeholder="Set due date" required>
                </div>
                <div class="form-group">
                    <hr>
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-plus mr-2"></i>Add task</button>
            </form>
        </div>
    </div>