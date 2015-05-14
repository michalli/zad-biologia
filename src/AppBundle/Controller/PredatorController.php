<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Predator;
use AppBundle\Form\PredatorType;

/**
 * Predator controller.
 *
 * @Route("/admin/predator")
 */
class PredatorController extends Controller
{

    /**
     * Lists all Predator entities.
     *
     * @Route("/", name="admin_predator")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Predator')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Predator entity.
     *
     * @Route("/", name="admin_predator_create")
     * @Method("POST")
     * @Template("AppBundle:Predator:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Predator();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_predator_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Predator entity.
     *
     * @param Predator $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Predator $entity)
    {
        $form = $this->createForm(new PredatorType(), $entity, array(
            'action' => $this->generateUrl('admin_predator_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Predator entity.
     *
     * @Route("/new", name="admin_predator_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Predator();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Predator entity.
     *
     * @Route("/{id}", name="admin_predator_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Predator')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Predator entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Predator entity.
     *
     * @Route("/{id}/edit", name="admin_predator_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Predator')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Predator entity.');
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
    * Creates a form to edit a Predator entity.
    *
    * @param Predator $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Predator $entity)
    {
        $form = $this->createForm(new PredatorType(), $entity, array(
            'action' => $this->generateUrl('admin_predator_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Predator entity.
     *
     * @Route("/{id}", name="admin_predator_update")
     * @Method("PUT")
     * @Template("AppBundle:Predator:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Predator')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Predator entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_predator_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Predator entity.
     *
     * @Route("/{id}", name="admin_predator_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Predator')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Predator entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_predator'));
    }

    /**
     * Creates a form to delete a Predator entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_predator_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
