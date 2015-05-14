<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Marsupials;
use AppBundle\Form\MarsupialsType;

/**
 * Marsupials controller.
 *
 * @Route("/admin/marsupials")
 */
class MarsupialsController extends Controller
{

    /**
     * Lists all Marsupials entities.
     *
     * @Route("/", name="admin_marsupials")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Marsupials')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Marsupials entity.
     *
     * @Route("/", name="admin_marsupials_create")
     * @Method("POST")
     * @Template("AppBundle:Marsupials:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Marsupials();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_marsupials_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Marsupials entity.
     *
     * @param Marsupials $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Marsupials $entity)
    {
        $form = $this->createForm(new MarsupialsType(), $entity, array(
            'action' => $this->generateUrl('admin_marsupials_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Marsupials entity.
     *
     * @Route("/new", name="admin_marsupials_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Marsupials();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Marsupials entity.
     *
     * @Route("/{id}", name="admin_marsupials_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Marsupials')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Marsupials entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Marsupials entity.
     *
     * @Route("/{id}/edit", name="admin_marsupials_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Marsupials')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Marsupials entity.');
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
    * Creates a form to edit a Marsupials entity.
    *
    * @param Marsupials $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Marsupials $entity)
    {
        $form = $this->createForm(new MarsupialsType(), $entity, array(
            'action' => $this->generateUrl('admin_marsupials_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Marsupials entity.
     *
     * @Route("/{id}", name="admin_marsupials_update")
     * @Method("PUT")
     * @Template("AppBundle:Marsupials:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Marsupials')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Marsupials entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_marsupials_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Marsupials entity.
     *
     * @Route("/{id}", name="admin_marsupials_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Marsupials')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Marsupials entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_marsupials'));
    }

    /**
     * Creates a form to delete a Marsupials entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_marsupials_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
