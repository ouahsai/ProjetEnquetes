<?php
namespace Entity;

class Pagination {
   
        private $nb_par_page = 500;
        private $nb_Query;
        protected $pageDebut = 0;
 
	 
	public function get_Nb_par_page()
	{
		return $this->nb_par_page;
	}
 
	
	public function get_number_pages()
	{
		return ceil($this->nb_Query / $this->nb_par_page);
	}
        
        public function set_number_pages($nb_Query)
        {
            $this->nb_Query = $nb_Query;
            return $this;
        }
        
        public function get_PageDebut()
	{
		return $this->pageDebut;
	}
        public function setPageDebut($pageDebut) {
            $this->pageDebut = ($pageDebut-1) * ($this->nb_par_page);
            return $this;
        }
        
        public function get_page_fin()
        {
            return ($this->nb_par_page) + ($this->get_PageDebut());
        }


}
