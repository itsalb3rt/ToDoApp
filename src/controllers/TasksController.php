<?php

use App\models\Tasks\Tasks;
use Symfony\Component\HttpFoundation\Request;

class TasksController extends Controller
{
    public function index(){
        $tasks = new Tasks();
        $data = [];
        $request = Request::createFromGlobals();
        $category = $request->query->filter('category','all');
        if($category == 'all'){
            $data['tasks'] = $tasks->get();
        }else{
            $data['tasks'] = $tasks->byCategory($category);
        }

        $this->setData($data);
        $this->render('index','Index - ToDo');
    }

    public function add(){
        $this->render('add','Add task - ToDo');
    }

    public function createTask(){
        $request = Request::createFromGlobals();
        if($request->server->get('REQUEST_METHOD') == 'POST'){
            $data = [
                'title'=>$request->request->filter('title'),
                'description'=>$request->request->filter('description'),
                'create_at'=>date('Y-m-d H:i:s'),
                'due_date'=>$request->request->filter('duedate'),
                'status'=>'pending',
                'category'=>$request->request->filter('category'),
            ];
            $task = new Tasks();
            $task->add($data);
            $this->redirect(['controller'=>'tasks','action'=>'index']);
        }
    }

    public function updateStatus($id){
        $request = Request::createFromGlobals();
        if($request->server->get('REQUEST_METHOD') == 'PATCH'){
            $task = new Tasks();
            $currentTaksData = $task->byId($id);
            if($currentTaksData->status == 'complete'){
                $task->updateStatus($id,['status'=>'pending']);
            }else{
                $task->updateStatus($id,['status'=>'complete']);
            }
            http_response_code(200);
            echo json_encode(['status'=>'success']);
        }
    }

    public function delete($id){
        $request = Request::createFromGlobals();
        if($request->server->get('REQUEST_METHOD') == 'GET'){
            $task = new Tasks();
            $task->delete($id);
            $this->redirect(['controller'=>'tasks','action'=>'index']);
        }
    }
}