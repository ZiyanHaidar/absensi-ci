<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Admin extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_model');
		$this->load->helper('my_helper');
		$this->load->library('upload');	
		if ($this->session->userdata('logged_in')  != true && $this->session->userdata('role') != 'admin') {
			redirect(base_url() . 'auth');
		}
	}
	// admin
	public function index()
	{
		$data['mapel'] = $this->m_model->get_data('mapel')->num_rows();
		$data['siswa'] = $this->m_model->get_data('siswa')->num_rows();
		$data['guru'] = $this->m_model->get_data('guru')->num_rows();
		$data['kelas'] = $this->m_model->get_data('kelas')->num_rows();
		$this->load->view('admin/index', $data);
	}
	public function upload_img($value)
{
    $kode = round(microtime(true) * 1000);
    $config['upload_path'] = './images/siswa/';
    $config['allowed_types'] = 'jpg|png|jpeg';
    $config['max_size'] = '30000';
    $config['file_name'] = $kode;
    
    $this->load->library('upload', $config); // Load library 'upload' with config
    
    if (!$this->upload->do_upload($value)) {
        return array(false, '');
    } else {
        $fn = $this->upload->data();
        $nama = $fn['file_name'];
        return array(true, $nama);
    }
}

	

	//from untuk siswa
	public function siswa()
	{
		$data['siswa'] = $this->m_model->get_data('siswa')->result();
		$this->load->view('admin/siswa', $data);
	}
	public function tambah_siswa()
	{
		$data['kelas'] = $this->m_model->get_data('kelas')->result();
		$this->load->view('admin/tambah_siswa', $data);
	}
	public function export()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $style_col = [
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $style_row = [
            'font' => ['bold' => true],
            'alignment' => [
                'vertical' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $sheet->setCellValue('A1', 'DATA SISWA');
        $sheet->mergeCells('A1:E1');
        $sheet
            ->getStyle('A1')
            ->getFont()
            ->setBold(true);

        $sheet->setCellValue('A3', 'ID');
        $sheet->setCellValue('B3', 'NAMA SISWA');
        $sheet->setCellValue('C3', 'NISN');
        $sheet->setCellValue('D3', 'GENDER');
        $sheet->setCellValue('E3', 'KELAS');

        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);

        // get dari database
        $data = $this->m_model->get_data_siswa();

        $no = 1;
        $numrow = 4;
        foreach ($data as $data) {
            $sheet->setCellValue('A' . $numrow, $data->id_siswa);
            $sheet->setCellValue('B' . $numrow, $data->nama_siswa);
            $sheet->setCellValue('C' . $numrow, $data->nisn);
            $sheet->setCellValue('D' . $numrow, $data->gender);
            $sheet->setCellValue(
                'E' . $numrow,
                $data->tingkat_kelas . ' ' . $data->jurusan_kelas
            );

            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);

            $no++;
            $numrow++;
        }

        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(20);
		$sheet->getColumnDimension('E')->setWidth(30);
        $sheet->getDefaultRowDimension()->setRowHeight(-1);

        $sheet
            ->getPageSetup()
            ->setOrientation(
                \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE
            );

        $sheet->setTitle('LAPORAN DATA SISWA');

        header(
            'Content-Type: aplication/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );
        header('Content-Disposition: attachment; filename="SISWA.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }


 public function import()  
 {  
   if (isset($_FILES["file"]["name"])) {  
	 $path = $_FILES["file"]["tmp_name"];  
	 $object = PhpOffice\PhpSpreadsheet\IOFactory::load($path);  
	 foreach ($object->getWorksheetIterator() as $worksheet) {  
	   $highestRow = $worksheet->getHighestRow();  
	   $highestColumn = $worksheet->getHighestColumn();  
	   for ($row = 2; $row <= $highestRow; $row++) {  
		 $foto = $worksheet->getCellByColumnAndRow(2, $row)->getValue();  
		 $nisn = $worksheet->getCellByColumnAndRow(4, $row)->getValue();  
		 $nama_siswa = $worksheet->getCellByColumnAndRow(3, $row)->getValue();  
		 $gender = $worksheet->getCellByColumnAndRow(5, $row)->getValue();  
		 $kelas = $worksheet->getCellByColumnAndRow(6, $row)->getValue(); 
   
		 // Periksa apakah ID siswa sudah ada  
		 $get_id_by_nisn = $this->m_model->get_by_nisn($nisn);  
		 $parts = explode(' ', $kelas);  
					   
		 // Ambil kata pertama  
		 $tingkat = $parts[0];  
		 $jurusan = $parts[1];  
		 $get_id_by_jurusan = $this->m_model->get_by_jurusan($jurusan, $tingkat);  

		 if (!$get_id_by_nisn) {  
		   // Jika ID siswa belum ada, masukkan data baru  
		   $data = array(  
			 'foto' => $foto,  
			 'nisn' => $nisn,  
			 'nama_siswa' => $nama_siswa,  
			 'gender' => $gender,  
	 'id_kelas' => $get_id_by_jurusan 
		   );  
		   $this->m_model->tambah_data('siswa', $data);  
		 } else {  
		   // Jika ID siswa sudah ada, lakukan tindakan yang sesuai 
		   // Misalnya, Anda bisa memperbarui data yang sudah ada  
		   $data = array(  
			 'foto' => $foto,  
			 'nisn' => $nisn,  
			 'nama_siswa' => $nama_siswa,  
			 'gender' => $gender,  
	 'id_kelas' => $get_id_by_jurusan 
		   );  
		   $this->m_model->ubah_data('siswa', $data, array('id_siswa' => $get_id_by_nisn));  
		 }  
	   }  
	 }  
	 redirect(base_url('admin/datasiswa'));  
   } else {  
	 echo 'Invalid File';  
   }  
 }

	
	public function aksi_tambah_siswa()
	{
		$foto = $this->upload_img('foto');
		if ($foto[0] == false) {
			$data = [
				'foto' => 'User.png',
				'nama_siswa' => $this->input->post('nama'),
				'nisn' => $this->input->post('nisn'),
				'gender' => $this->input->post('gender'),
				'id_kelas' => $this->input->post('kelas'),
			];

			$this->m_model->tambah_data('siswa', $data);
			redirect(base_url('admin/siswa'));
		} else {
			$data = [
				'foto' => $foto[1],
				'nama_siswa' => $this->input->post('nama'),
				'nisn' => $this->input->post('nisn'),
				'gender' => $this->input->post('gender'),
				'id_kelas' => $this->input->post('kelas'),
			];

			$this->m_model->tambah_data('siswa', $data);
			redirect(base_url('admin/siswa'));
		}

	}

	
	public function ubah_siswa($id)
	{
		$data['siswa'] = $this->m_model->get_by_id('siswa', 'id_siswa', $id)->result();
		$data['kelas'] = $this->m_model->get_data('kelas')->result();
         $this->load->view('admin/ubah_siswa', $data);
	}
	public function aksi_ubah_siswa()
	{
		$foto = $_FILES['foto']['name'];
		$foto_temp = $_FILES['foto']['tmp_name'];

		// Jika ada foto yang diunggah
		if ($foto) {
			$kode = round(microtime(true) * 1000);
			$file_name = $kode . '_' . $foto;
			$upload_path = './images/siswa/' . $file_name;

			if (move_uploaded_file($foto_temp, $upload_path)) {
				// Hapus foto lama jika ada
				$old_file = $this->m_model->get_siswa_foto_by_id($this->input->post('id_siswa'));
				if ($old_file && file_exists('./images/siswa/' . $old_file)) {
					unlink('./images/siswa/' . $old_file);
				}

				$data = [
					'foto' => $file_name,
					'nama_siswa' => $this->input->post('nama'),
					'nisn' => $this->input->post('nisn'),
					'gender' => $this->input->post('gender'),
					'id_kelas' => $this->input->post('kelas'),
				];
			} else {
				// Gagal mengunggah foto baru
				redirect(base_url('admin/ubah_siswa/' . $this->input->post('id_siswa')));
			}
		} else {
			// Jika tidak ada foto yang diunggah
			$data = [
				'nama_siswa' => $this->input->post('nama'),
				'nisn' => $this->input->post('nisn'),
				'gender' => $this->input->post('gender'),
				'id_kelas' => $this->input->post('kelas'),
			];
		}

		// Eksekusi dengan model ubah_data
		$eksekusi = $this->m_model->ubah_data('siswa', $data, array('id_siswa' => $this->input->post('id_siswa')));

		if ($eksekusi) {
			redirect(base_url('admin/siswa'));
		} else {
			redirect(base_url('admin/ubah_siswa/' . $this->input->post('id_siswa')));
		}
	}

	// hapus 
	public function hapus_siswa($id)
		{
			$siswa = $this->m_model->get_by_id('siswa', 'id_siswa', $id)->row();
			if($siswa){
				if($siswa->foto !== 'User.png'){
					$file_path = './images/siswa/' . $siswa->foto;

					if(file_exists($file_path)){
						if(unlink($file_path)){
							//hapus file berhasil menggunakan model delete
							$this->m_model->delete('siswa', 'id_siswa',$id);
							redirect(base_url('admin/siswa'));
						}else{
							//gagal menghapus file
							echo "gagal menghapus file.";
						}
					}else{
						//file tidak di temukan
						echo "File Tidak Di Temukan"; 
					}
				}else{
					//Tanpa Hapus File User.png
					$this->m_model->delete('siswa', 'id_siswa', $id);
					redirect(base_url('admin/siswa'));
				}
			}else{
				//Siswa Tidak Di Temukan
				echo "Siswa Tidak Di Temukan";
			}
		}

	public function akun()
	{
		$data['user'] = $this->m_model->get_by_id('admin', 'id', $this->session->userdata('id'))->result();
		$this->load->view('admin/akun', $data);
	}
// from untuk ubah akun
public function aksi_ubah_akun()
 {
	$passswod_baru = $this->input->post('password_baru');
	$konfirmasi_password = $this->input->post('konfirmasi_password');
	$email = $this->input->post('email');
	$username = $this->input->post('username');

	//data yg akan diubah
	$data = [
		'email'=> $email,
		'username'=> $username,
	];

	//kondisi jika ada password baru
	if (!empty($password_baru)) {
		//pastikan password baru dan konfirmasi password sama
		if ($password_baru === $konfirmasi_password){
			//wadah password baru
			$data['password'] = md5($password_baru);
		} else {
			$this->session->set_flashdata('message', 'Password baru dan konfirmasi password harus sama');
			redirect(base_url('admin/akun'));
		}
	}

	//untuk melakukan pembaruan data
	$this->session->set_userdata($data);
	$update_result = $this->m_model->ubah_data('admin', $data, array('id' => $this->session->userdata('id')));

	if ($update_result) {
		redirect(base_url('admin/akun'));
	} else {
		redirect(base_url('admin/akun'));
	}
  }
 

}
?>