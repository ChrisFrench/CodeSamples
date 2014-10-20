<?php 
namespace Rystband\Site\Controllers;

class Register extends Base 
{   

    //register a band to a person
    public function doAdd() {

       $tag = $this->validateTag();

        // save
        try {
           $model = new \Rystband\Models\Users;
           

           $inputfilter = new \Joomla\Filter\InputFilter;
           $data = \Base::instance()->get('REQUEST');
           $data['tagid'] = $tag->id;
           $item = $model->create($data);


           $tag->set('user.id',$item->id);
           $tag->set('user.name',$item->first_name . ' ' . $item->last_name);
           $tag->save();

           if($item->id) {
            //todo make a get/setIdentity method like f3-users users
            \Dsc\System::instance()->get( 'session' )->set( 'attendee', $item );
            \Dsc\System::instance()->get( 'session' )->set( 'home', '/b/'. $tag->tagid );
            \Base::instance()->reroute('/b/'.$tag->tagid);
           }

           //if created set the auth and than  redirect back to their band url

        }
        catch (\Exception $e) {

        }
      


    }
    

    protected function validateTag() {

        $model = new \Rystband\Site\Models\Tags;
        $model->setState('filter.tagid', \Base::instance()->get('SESSION.tagid'));
        $tag = $model->getItem();

        //TODO do some checks on this tag to make sure we can register/ now we can redirect


        return $tag;

    }
    
}
