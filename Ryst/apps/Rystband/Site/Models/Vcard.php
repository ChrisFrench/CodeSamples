<?php
namespace Rystband\Site\Models;
/**
 * @file
 * A class to generate vCards for contact data.
 */

class Vcard
{
    // An array of this vcard's contact data.
    protected $data;
    // Filename for download file naming.
    protected $filename;
    // vCard class: PUBLIC, PRIVATE, CONFIDENTIAL.
    protected $class;
    // vCard revision date.
    protected $revision_date;
    // The vCard gnerated.
    protected $card;
  
    /**
     * The constructor.
     */
    public function __construct()
    {
        $this->data = array(
            'display_name' => 'Leila Weller',
            'first_name' => 'Leila',
            'last_name' => 'Weller',
            'additional_name' => NULL,
            'name_prefix' => NULL,
            'name_suffix' => NULL,
            'nickname' => NULL,
            'title' => NULL,
            'role' => NULL,
            'department' => NULL,
            'company' => NULL,
            'work_po_box' => NULL,
            'work_extended_address' => NULL,
            'work_address' => NULL,
            'work_city' => NULL,
            'work_state' => NULL,
            'work_postal_code' => NULL,
            'work_country' => NULL,
            'home_po_box' => NULL,
            'home_extended_address' => NULL,
            'home_address' => NULL,
            'home_city' => NULL,
            'home_state' => NULL,
            'home_postal_code' => NULL,
            'home_country' => NULL,
            'office_tel' => '905.282.2637',
            'home_tel' => NULL,
            'cell_tel' => '416.997.3925',
            'fax_tel' => NULL,
            'pager_tel' => NULL,
            'email1' => 'leila.weller@bell.ca',
            'email2' => NULL,
            'url' => NULL,
            'photo' => 'https://media.licdn.com/mpr/mpr/shrink_200_200/p/3/000/291/049/2e3eeba.jpg',
            'birthday' => NULL,
            'timezone' => NULL,
            'sort_string' => NULL,
            'note' => NULL,
        );

        return true;
    }

    /**
     * Global setter.
     * 
     * @param string $key
     *   Name of the property.
     * @param mixed $value
     *   Value to set.
     * 
     * @return vCard
     *   Return itself.
     */
    public function set($key, $value)
    {
        // Check if the specified property is defined.
        if (property_exists($this, $key) && $key != 'data') {
            $this->{$key} = trim($value);
            return $this;
        } elseif (property_exists($this, $key) && $key == 'data') {
            foreach ($value as $v_key => $v_value) {
                $this->{$key}[$v_key] = trim($v_value);
            }
            return $this;
        } else {
            return FALSE;
        }
    }

    public function setData($key, $value)
    {   
        
        $this->data[$key] = $value;
         return $this;
        
    }

    /**
     * Checks all the values, builds appropriate defaults for
     * missing values and generates the vcard data string.
     */  
    function build()
    {
        if (!$this->class) {
            $this->class = 'PUBLIC';
        }
        if (!$this->data['display_name']) {
            $this->data['display_name'] = $this->data['first_name'] . ' ' . $this->data['last_name'];
        }
        if (!$this->data['sort_string']) {
            $this->data['sort_string'] = $this->data['last_name'];
        }
        if (!$this->data['sort_string']) {
            $this->data['sort_string'] = $this->data['company'];
        }
        if (!$this->data['timezone']) {
            $this->data['timezone'] = date("O");
        }
        if (!$this->revision_date) {
            $this->revision_date = date('Y-m-d H:i:s');
        }

        $this->card = "BEGIN:VCARD\r\n";
        $this->card .= "VERSION:3.0\r\n";
        $this->card .= "CLASS:" . $this->class . "\r\n";
        $this->card .= "PRODID:-//class_vCard from WhatsAPI//NONSGML Version 1//EN\r\n";
        $this->card .= "REV:" . $this->revision_date . "\r\n";
        $this->card .= "FN:" . $this->data['display_name'] . "\r\n";
        $this->card .= "N:"
            . $this->data['last_name'] . ";"
            . $this->data['first_name'] . ";"
            . $this->data['additional_name'] . ";"
            . $this->data['name_prefix'] . ";"
            . $this->data['name_suffix'] . "\r\n";
        if ($this->data['nickname']) {
            $this->card .= "NICKNAME:" . $this->data['nickname'] . "\r\n";
        }
  	    if ($this->data['title']) {
            $this->card .= "TITLE:" . $this->data['title'] . "\r\n";
        }
        if ($this->data['company']) {
            $this->card .= "ORG:" . $this->data['company'];
        }
        if ($this->data['department']) {
            $this->card .= ";".$this->data['department'];
        }
  	    $this->card .= "\r\n";

  	    if ($this->data['work_po_box'] || $this->data['work_extended_address']
  	        || $this->data['work_address'] || $this->data['work_city']
      	    || $this->data['work_state'] || $this->data['work_postal_code']
      	    || $this->data['work_country']) {
  	            $this->card .= "ADR;type=WORK:"
                    . $this->data['work_po_box'] . ";"
                    . $this->data['work_extended_address'] . ";"
                    . $this->data['work_address'] . ";"
                    . $this->data['work_city'] . ";"
                    . $this->data['work_state'] . ";"
                    . $this->data['work_postal_code'] . ";"
                    . $this->data['work_country'] . "\r\n";
  	    }

  	    if ($this->data['home_po_box'] || $this->data['home_extended_address']
  	        || $this->data['home_address'] || $this->data['home_city']
  	        || $this->data['home_state'] || $this->data['home_postal_code']
  	        || $this->data['home_country']) {
  	            $this->card .= "ADR;type=HOME:"
  	                . $this->data['home_po_box'] . ";"
  	                . $this->data['home_extended_address'] . ";"
  	                . $this->data['home_address'] . ";"
  	                . $this->data['home_city'] . ";"
  	                . $this->data['home_state'] . ";"
  	                . $this->data['home_postal_code'] . ";"
  	                . $this->data['home_country'] . "\r\n";
   	    }
   	    if ($this->data['email1']) {
            $this->card .= "EMAIL;type=INTERNET,pref:" . $this->data['email1'] . "\r\n";
   	    }
   	    if ($this->data['email2']) {
            $this->card .= "EMAIL;type=INTERNET:" . $this->data['email2'] . "\r\n";
        }

   	    if ($this->data['office_tel']) {
            $this->card .= "TEL;type=WORK,voice:" . $this->data['office_tel'] . "\r\n";
   	    }
   	    if ($this->data['home_tel']) {
            $this->card .= "TEL;type=HOME,voice:" . $this->data['home_tel'] . "\r\n";
   	    }
   	    if ($this->data['cell_tel']) {
            $this->card .= "TEL;type=CELL,voice:" . $this->data['cell_tel'] . "\r\n";
   	    }
   	    if ($this->data['fax_tel']) {
            $this->card .= "TEL;type=WORK,fax:" . $this->data['fax_tel'] . "\r\n";
   	    }
   	    if ($this->data['pager_tel']) {
            $this->card .= "TEL;type=WORK,pager:" . $this->data['pager_tel'] . "\r\n";
   	    }
   	    if ($this->data['url']) {
            $this->card .= "URL;type=WORK:" . $this->data['url'] . "\r\n";
   	    }
   	    if ($this->data['birthday']) {
            $this->card .= "BDAY:" . $this->data['birthday'] . "\r\n";
   	    }
   	    if ($this->data['role']) {
            $this->card .= "ROLE:" . $this->data['role'] . "\r\n";
   	    }
   	    if ($this->data['note']) {
            $this->card .= "NOTE:" . $this->data['note'] . "\r\n";
   	    }
   	    $this->card .= "TZ:" . $this->data['timezone'] . "\r\n";
         if ($this->data['photo']) {
            $this->card .= $this->photo();
            $this->card .= "\r\n";
        }
   	    $this->card .= "END:VCARD\r\n";
    }
    
    function photo() {
       return "PHOTO;ENCODING=BASE64;TYPE=jpg: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";

    }
    /**
     * Streams the vcard to the browser client.
     */
    function download()
    {
        if (!$this->card) {
            $this->build();
        }

        if (!$this->filename) {
            $this->filename = $this->data['display_name'];
        }

        $this->filename = str_replace(' ', '_', $this->filename);

        header("Content-type: text/x-vcard");
        header("Content-Disposition: attachment; filename=" . $this->filename . ".vcf");
        header("Pragma: public");
        echo $this->card;

        return TRUE;
    }

    /**
     * Show the vcard.
     */
    function show()
    {
        if (!$this->card) {
            $this->build();
        }

        return $this->card;
    }
}