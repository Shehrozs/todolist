$(document).ready(function(){
    let edit = false;
    $('#task-result').hide();
    getTasks();
    $('#search').keyup(function (e) { 
        if ($('#search').val()) {
            let taskSearch = $('#search').val();
            $.ajax({
                type: "POST",
                url: "php/task-search.php",
                data: {taskSearch},
                success: function (response) {
                    let tasksJSON = JSON.parse(response);
                    console.log(tasksJSON);
                    let template = '';
                    tasksJSON.forEach(task => {
                        template += `<li>
                            ${task.name}
                        </li>`
                    });
                    $('#task-container').html(template);
                    $('#task-result').show();
                }
            });
        }
        else{
            $('#task-result').hide();
        }
    });
    $('#task-form').submit(function (e) { 
        e.preventDefault();
		
	let today = new Date();
	let dd = String(today.getDate()).padStart(2, '0');
	let mm = String(today.getMonth() + 1).padStart(2, '0');
	let yyyy = today.getFullYear();
	today = dd + `.` + mm +  `.` + yyyy;
        const postData = {
            id: $('#taskID').val(),
            name: $('#taskName').val(),
            date: today
        };
        let url = edit === false ? 'php/task-add.php' : 'php/task-edit.php';
        $.post(url, postData, function (response) {
            console.log(response);
            getTasks();
            $('#task-form').trigger('reset');
			$("#addTask").html('Add').removeClass('btn-warning');
        });
    });
    function getTasks(){
        $.ajax({
            type: "GET",
            url: "php/task-list.php",
            success: function (response) {
                let taskList = JSON.parse(response);
                let template = '';
                let i = 1;
                taskList.forEach(task =>{
                    template +=`
                        <tr taskID="${task.id}">
                            <td>${i++}</td>
                            <td>
                                <a href="#" class="task-item">${task.name}</a>
                            </td>
                            <td>${task.date}</td>
                            <td>
                                <button class="btn btn-sm btn-danger task-delete">X</button>
                            </td>
                        </tr>
                    `
                });
                $('#tableTasks').html(template);
            }
        });
    }
    $(document).on('click','.task-delete',function () {
        if (confirm('Are you sure?')) {
            let element = $(this)[0].parentElement.parentElement;
            let id = $(element).attr('taskID');
            $.post("php/task-delete.php", {id},function (response) {
                console.log(response);
                getTasks();
            });
        }
    });
    $(document).on('click','.task-item',function () {
        let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr('taskID');
		$("#addTask").html('Edit').addClass('btn-warning');
        $.post("php/task-single.php", {id},function (response) {
            const taskUpdate = JSON.parse(response);
            $('#taskID').val(taskUpdate.id);
            $('#taskName').val(taskUpdate.name);
            $('#taskdate').val(taskUpdate.date);
            edit = true;
        });
    });
});

