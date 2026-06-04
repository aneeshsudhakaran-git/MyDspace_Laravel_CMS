rule 
{
	meta:
		author = "test"
	strings:
		$lure1 = "Job Description" ascii
		$lure2 = "Job Vacancies" ascii

	condition:
		uint32be(0x0) == 0x71514141 
		and filesize < 2MB
		and 1 of them

}