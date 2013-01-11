<?php

namespace Todo\TodoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


use Todo\TodoBundle\Model\User;
use Todo\TodoBundle\Model\Status;
use Todo\TodoBundle\Model\Priority;
use Todo\TodoBundle\Model\Task;
use Todo\TodoBundle\Model\TaskQuery as TaskQuery;
use Todo\TodoBundle\Model\StatusQuery as StatusQuery;
use Todo\TodoBundle\Model\UserQuery as UserQuery;
use Todo\TodoBundle\Model\PriorityQuery as PriorityQuery;
use Todo\TodoBundle\Form\Type\UserType as UserType;
use Todo\TodoBundle\Form\Type\PriorityType as PriorityType;
use Todo\TodoBundle\Form\Type\StatusType as StatusType;
use Todo\TodoBundle\Form\Type\TaskType as TaskType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $tasks = TaskQuery::create()
                ->orderByPriorityId('asc')
                ->orderByCreatedAt('asc')
                ->find();
        
        return $this->render('TodoBundle::index.html.twig',array('tasks'=>$tasks));
    }
    
    public function indexUserAction()
    {
        $users = UserQuery::create()
                ->orderById('asc')
                ->find();
        return $this->render('TodoBundle::index_user.html.twig',array('users'=>$users));
    }
    
    public function editUserAction($id)
    {
        $user = UserQuery::create()
                ->filterById($id)
                ->findOne();
        $form = $this->createForm(new UserType(), $user);
        
        $request = $this->getRequest();

        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $user->save();

                return $this->redirect($this->generateUrl('_user_list'));
            }
        }

        
        return $this->render('TodoBundle::edit_user.html.twig', array(
            'form' => $form->createView(),'user'=>$user
        ));
    }
    
    public function newUserAction()
    {
        $user = new User();
        $form = $this->createForm(new UserType(), $user);

        $request = $this->getRequest();

        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $user->save();

                return $this->redirect($this->generateUrl('_user_list'));
            }
        }

        
        return $this->render('TodoBundle::new_user.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    
    public function newTaskAction()
    {
        $task = new Task();
        $form = $this->createForm(new TaskType(), $task);
        

        $request = $this->getRequest();

        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                
               
                
                $task->setStatusId(3);
                
                $task->save();

                return $this->redirect($this->generateUrl('_welcome'));
            }
        }

        
        return $this->render('TodoBundle::new_task.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    
    public function editTaskAction($id)
    {
        $task = TaskQuery::create()
                ->filterById($id)
                ->findOne();
        $form = $this->createForm(new TaskType(), $task);
        
        
        $request = $this->getRequest();

        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);
            if ($form->isValid()) {
            
                
                $task->save();

                return $this->redirect($this->generateUrl('_welcome'));
            }
        }

        
        return $this->render('TodoBundle::edit_task.html.twig', array(
            'form' => $form->createView(),'task'=>$task));
    }
    
    
    public function newStatusAction()
    {
        $status = new Status();
        $form = $this->createForm(new StatusType(), $status);

        $request = $this->getRequest();

        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $status->save();

                return $this->redirect($this->generateUrl('_status_list'));
            }
        }

        
        return $this->render('TodoBundle::new_status.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    
    public function editStatusAction($id)
    {
        $status = StatusQuery::create()
                ->filterById($id)
                ->findOne();
        $form = $this->createForm(new StatusType(), $status);
        
        $request = $this->getRequest();

        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $status->save();

                return $this->redirect($this->generateUrl('_status_list'));
            }
        }

        
        return $this->render('TodoBundle::edit_status.html.twig', array(
            'form' => $form->createView(),'status'=>$status
        ));
    }
    
    public function newPriorityAction()
    {
        $priority = new Priority();
        $form = $this->createForm(new PriorityType(), $priority);

        $request = $this->getRequest();

        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $priority->save();

                return $this->redirect($this->generateUrl('_priority_list'));
            }
        }

        
        return $this->render('TodoBundle::new_priority.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    
    public function editPriorityAction($id)
    {
        $priority = PriorityQuery::create()
                ->filterById($id)
                ->findOne();
        $form = $this->createForm(new PriorityType(), $priority);
        
        $request = $this->getRequest();

        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $priority->save();

                return $this->redirect($this->generateUrl('_priority_list'));
            }
        }

        
        return $this->render('TodoBundle::edit_priority.html.twig', array(
            'form' => $form->createView(),'priority'=>$priority
        ));
    }
    
    
    
    public function indexPriorityAction()
    {
        $priorities = PriorityQuery::create()
                ->orderById('asc')
                ->find();
        return $this->render('TodoBundle::index_priority.html.twig',array('priorities'=>$priorities));
        
    }
    
    public function indexStatusAction()
    {
        $statuses = StatusQuery::create()
                ->orderById('asc')
                ->find();
        return $this->render('TodoBundle::index_status.html.twig',array('statuses'=>$statuses));
    }
}
