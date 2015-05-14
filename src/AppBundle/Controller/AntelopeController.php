<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Antelope;
use AppBundle\Form\AntelopeType;

/**
 * Antelope controller.
 *
 * @Route("/admin/antelope")
 */
class AntelopeController extends Controller
{

    /**
     * Lists all Antelope entities.
     *
     * @Route("/", name="admin_antelope")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Antelope')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Antelope entity.
     *
     * @Route("/", name="admin_antelope_create")
     * @Method("POST")
     * @Template("AppBundle:Antelope:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Antelope();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_antelope_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Antelope entity.
     *
     * @param Antelope $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Antelope $entity)
    {
        $form = $this->createForm(new AntelopeType(), $entity, array(
            'action' => $this->generateUrl('admin_antelope_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Antelope entity.
     *
     * @Route("/new", name="admin_antelope_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Antelope();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Antelope entity.
     *
     * @Route("/{id}", name="admin_antelope_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Antelope')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Antelope entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Antelope entity.
     *
     * @Route("/{id}/edit", name="admin_antelope_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Antelope')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Antelope entity.');
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
    * Creates a form to edit a Antelope entity.
    *
    * @param Antelope $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Antelope $entity)
    {
        $form = $this->createForm(new AntelopeType(), $entity, array(
            'action' => $this->generateUrl('admin_antelope_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Antelope entity.
     *
     * @Route("/{id}", name="admin_antelope_update")
     * @Method("PUT")
     * @Template("AppBundle:Antelope:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Antelope')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Antelope entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_antelope_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Antelope entity.
     *
     * @Route("/{id}", name="admin_antelope_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Antelope')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Antelope entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_antelope'));
    }

    /**
     * Creates a form to delete a Antelope entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_antelope_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
