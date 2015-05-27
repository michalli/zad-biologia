<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Fruit;
use AppBundle\Form\FruitType;

/**
 * Fruit controller.
 *
 * @Route("/admin/fruit")
 */
class FruitController extends Controller
{

    /**
     * Lists all Fruit entities.
     *
     * @Route("/", name="admin_fruit")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Fruit')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Fruit entity.
     *
     * @Route("/", name="admin_fruit_create")
     * @Method("POST")
     * @Template("AppBundle:Fruit:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Fruit();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_fruit_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Fruit entity.
     *
     * @param Fruit $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Fruit $entity)
    {
        $form = $this->createForm(new FruitType(), $entity, array(
            'action' => $this->generateUrl('admin_fruit_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Fruit entity.
     *
     * @Route("/new", name="admin_fruit_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Fruit();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Fruit entity.
     *
     * @Route("/{id}", name="admin_fruit_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Fruit')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fruit entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Fruit entity.
     *
     * @Route("/{id}/edit", name="admin_fruit_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Fruit')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fruit entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Fruit entity.
    *
    * @param Fruit $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Fruit $entity)
    {
        $form = $this->createForm(new FruitType(), $entity, array(
            'action' => $this->generateUrl('admin_fruit_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Fruit entity.
     *
     * @Route("/{id}", name="admin_fruit_update")
     * @Method("PUT")
     * @Template("AppBundle:Fruit:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Fruit')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fruit entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_fruit_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Fruit entity.
     *
     * @Route("/{id}", name="admin_fruit_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Fruit')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Fruit entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_fruit'));
    }

    /**
     * Creates a form to delete a Fruit entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_fruit_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
