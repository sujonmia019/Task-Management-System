<div class="modal fade" id="tast_add_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-1">
            <div class="modal-header py-1">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="btn-close shadow-none" style="font-size: 10px;" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="tast_add_form" method="POST">
                    @csrf
                    <input type="hidden" id="status" name="status">
                    <input type="hidden" id="update_id" name="update_id">
                    <input type="hidden" id="task_board" name="task_board" value="task_board">
                    <div class="mb-3">
                        <label for="title" class="required">Title</label>
                        <input type="text" name="title" id="title" class="form-control form-control-sm rounded-0 shadow-none" placeholder="Enter title">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="required">Description</label>
                        <textarea name="description" id="description" rows="3" class="form-control form-control-sm rounded-0 shadow-none" placeholder="Enter task description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="due_date">Due Date</label>
                        <input type="text" name="due_date" id="due_date" class="form-control form-control-sm rounded-0 shadow-none" placeholder="Y-m-d" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="priority" class="required">Priority</label>
                        <select name="priority" id="priority" class="form-control form-control-sm rounded-0 shadow-none">
                            <option value="">Select Priority</option>
                            @foreach (PRIORITY as $key=>$value)
                            <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
                <div class="text-end">
                    <button type="button" class="btn btn-danger btn-sm fw-normal" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-sm fw-normal" id="save_btn"></button>
                </div>
            </div>
        </div>
    </div>
</div>
