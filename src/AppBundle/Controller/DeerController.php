<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Deer;
use AppBundle\Form\DeerType;

/**
 * Deer controller.
 *
 * @Route("/admin/deer")
 */
class DeerController extends Controller
{

    /**
     * Lists all Deer entities.
     *
     * @Route("/", name="admin_deer")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Deer')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Deer entity.
     *
     * @Route("/", name="admin_deer_create")
     * @Method("POST")
     * @Template("AppBundle:Deer:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Deer();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_deer_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Deer entity.
     *
     * @param Deer $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Deer $entity)
    {
        $form = $this->createForm(new DeerType(), $entity, array(
            'action' => $this->generateUrl('admin_deer_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Deer entity.
     *
     * @Route("/new", name="admin_deer_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Deer();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Deer entity.
     *
     * @Route("/{id}", name="admin_deer_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Deer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Deer entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Deer entity.
     *
     * @Route("/{id}/edit", name="admin_deer_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Deer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Deer entity.');
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
    * Creates a form to edit a Deer entity.
    *
    * @param Deer $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Deer $entity)
    {
        $form = $this->createForm(new DeerType(), $entity, array(
            'action' => $this->generateUrl('admin_deer_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Deer entity.
     *
     * @Route("/{id}", name="admin_deer_update")
     * @Method("PUT")
     * @Template("AppBundle:Deer:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Deer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Deer entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_deer_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Deer entity.
     *
     * @Route("/{id}", name="admin_deer_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Deer')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Deer entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_deer'));
    }

    /**
     * Creates a form to delete a Deer entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_deer_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
