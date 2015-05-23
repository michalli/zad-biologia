<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Otter;
use AppBundle\Form\OtterType;

/**
 * Otter controller.
 *
 * @Route("/admin/otter")
 */
class OtterController extends Controller
{

    /**
     * Lists all Otter entities.
     *
     * @Route("/", name="admin_otter")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Otter')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Otter entity.
     *
     * @Route("/", name="admin_otter_create")
     * @Method("POST")
     * @Template("AppBundle:Otter:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Otter();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_otter_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Otter entity.
     *
     * @param Otter $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Otter $entity)
    {
        $form = $this->createForm(new OtterType(), $entity, array(
            'action' => $this->generateUrl('admin_otter_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Otter entity.
     *
     * @Route("/new", name="admin_otter_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Otter();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Otter entity.
     *
     * @Route("/{id}", name="admin_otter_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Otter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Otter entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Otter entity.
     *
     * @Route("/{id}/edit", name="admin_otter_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Otter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Otter entity.');
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
    * Creates a form to edit a Otter entity.
    *
    * @param Otter $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Otter $entity)
    {
        $form = $this->createForm(new OtterType(), $entity, array(
            'action' => $this->generateUrl('admin_otter_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Otter entity.
     *
     * @Route("/{id}", name="admin_otter_update")
     * @Method("PUT")
     * @Template("AppBundle:Otter:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Otter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Otter entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_otter_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Otter entity.
     *
     * @Route("/{id}", name="admin_otter_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Otter')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Otter entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_otter'));
    }

    /**
     * Creates a form to delete a Otter entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_otter_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
