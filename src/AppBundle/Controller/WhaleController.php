<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Whale;
use AppBundle\Form\WhaleType;

/**
 * Whale controller.
 *
 * @Route("/admin/whale")
 */
class WhaleController extends Controller
{

    /**
     * Lists all Whale entities.
     *
     * @Route("/", name="admin_whale")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Whale')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Whale entity.
     *
     * @Route("/", name="admin_whale_create")
     * @Method("POST")
     * @Template("AppBundle:Whale:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Whale();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_whale_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Whale entity.
     *
     * @param Whale $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Whale $entity)
    {
        $form = $this->createForm(new WhaleType(), $entity, array(
            'action' => $this->generateUrl('admin_whale_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Whale entity.
     *
     * @Route("/new", name="admin_whale_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Whale();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Whale entity.
     *
     * @Route("/{id}", name="admin_whale_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Whale')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Whale entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Whale entity.
     *
     * @Route("/{id}/edit", name="admin_whale_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Whale')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Whale entity.');
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
    * Creates a form to edit a Whale entity.
    *
    * @param Whale $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Whale $entity)
    {
        $form = $this->createForm(new WhaleType(), $entity, array(
            'action' => $this->generateUrl('admin_whale_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Whale entity.
     *
     * @Route("/{id}", name="admin_whale_update")
     * @Method("PUT")
     * @Template("AppBundle:Whale:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Whale')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Whale entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_whale_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Whale entity.
     *
     * @Route("/{id}", name="admin_whale_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Whale')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Whale entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_whale'));
    }

    /**
     * Creates a form to delete a Whale entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_whale_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
