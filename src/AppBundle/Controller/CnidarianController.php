<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Cnidarian;
use AppBundle\Form\CnidarianType;

/**
 * Cnidarian controller.
 *
 * @Route("/admin/cnidarian")
 */
class CnidarianController extends Controller
{

    /**
     * Lists all Cnidarian entities.
     *
     * @Route("/", name="admin_cnidarian")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Cnidarian')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Cnidarian entity.
     *
     * @Route("/", name="admin_cnidarian_create")
     * @Method("POST")
     * @Template("AppBundle:Cnidarian:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Cnidarian();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_cnidarian_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Cnidarian entity.
     *
     * @param Cnidarian $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Cnidarian $entity)
    {
        $form = $this->createForm(new CnidarianType(), $entity, array(
            'action' => $this->generateUrl('admin_cnidarian_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Cnidarian entity.
     *
     * @Route("/new", name="admin_cnidarian_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Cnidarian();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Cnidarian entity.
     *
     * @Route("/{id}", name="admin_cnidarian_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Cnidarian')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cnidarian entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Cnidarian entity.
     *
     * @Route("/{id}/edit", name="admin_cnidarian_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Cnidarian')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cnidarian entity.');
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
    * Creates a form to edit a Cnidarian entity.
    *
    * @param Cnidarian $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Cnidarian $entity)
    {
        $form = $this->createForm(new CnidarianType(), $entity, array(
            'action' => $this->generateUrl('admin_cnidarian_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Cnidarian entity.
     *
     * @Route("/{id}", name="admin_cnidarian_update")
     * @Method("PUT")
     * @Template("AppBundle:Cnidarian:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Cnidarian')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cnidarian entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_cnidarian_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Cnidarian entity.
     *
     * @Route("/{id}", name="admin_cnidarian_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Cnidarian')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Cnidarian entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_cnidarian'));
    }

    /**
     * Creates a form to delete a Cnidarian entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_cnidarian_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
