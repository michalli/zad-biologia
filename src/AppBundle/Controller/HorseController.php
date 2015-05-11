<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Horse;
use AppBundle\Form\HorseType;

/**
 * Horse controller.
 *
 * @Route("/admin/horse")
 */
class HorseController extends Controller
{

    /**
     * Lists all Horse entities.
     *
     * @Route("/", name="admin_horse")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Horse')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Horse entity.
     *
     * @Route("/", name="admin_horse_create")
     * @Method("POST")
     * @Template("AppBundle:Horse:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Horse();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_horse_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Horse entity.
     *
     * @param Horse $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Horse $entity)
    {
        $form = $this->createForm(new HorseType(), $entity, array(
            'action' => $this->generateUrl('admin_horse_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Horse entity.
     *
     * @Route("/new", name="admin_horse_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Horse();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Horse entity.
     *
     * @Route("/{id}", name="admin_horse_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Horse')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Horse entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Horse entity.
     *
     * @Route("/{id}/edit", name="admin_horse_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Horse')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Horse entity.');
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
    * Creates a form to edit a Horse entity.
    *
    * @param Horse $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Horse $entity)
    {
        $form = $this->createForm(new HorseType(), $entity, array(
            'action' => $this->generateUrl('admin_horse_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Horse entity.
     *
     * @Route("/{id}", name="admin_horse_update")
     * @Method("PUT")
     * @Template("AppBundle:Horse:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Horse')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Horse entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_horse_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Horse entity.
     *
     * @Route("/{id}", name="admin_horse_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Horse')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Horse entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_horse'));
    }

    /**
     * Creates a form to delete a Horse entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_horse_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
