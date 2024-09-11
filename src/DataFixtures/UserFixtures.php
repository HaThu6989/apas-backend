<?php

namespace App\DataFixtures;

// use App\Entity\{LaborUnion, User, Declaration, Bill, Company};
use App\Entity\{User};
// use App\Helper\DeclarationHelper;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
// use App\Helper\{UserHelper, CompanyHelper, MoneyHelper};
use Faker;
// use App\Model\DeclarationFormModel;
// use App\Service\BillService;
// use Money\Money;

class UserFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $userPasswordHasher,
        private ValidatorInterface $validator,
        // private DeclarationHelper $declarationHelper,
        // private UserHelper $userHelper,
        // private CompanyHelper $companyHelper,
        // private MoneyHelper $moneyHelper,
        // private BillService $billService
    ) {
        // ...
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        // // UNIONS
        // $union = new LaborUnion();
        // $union->setLabel('aucun');
        // $union->setActive(true);
        // $manager->persist($union);

        // $union = new LaborUnion();
        // $union->setLabel('CAPEB');
        // $union->setActive(true);
        // $manager->persist($union);


        // $union = new LaborUnion();
        // $union->setLabel('FFB');
        // $union->setActive(true);
        // $manager->persist($union);

        // $manager->flush();

        // // USERS
        $plainPassword = '$ApasBTPFormulaire2024!';
        // $none = $manager->getRepository(LaborUnion::class)->find(1);
        // $capeb = $manager->getRepository(LaborUnion::class)->find(2);
        // $ffb = $manager->getRepository(LaborUnion::class)->find(3);


        $user = new User();
        $user->setEmail('admin@aaa.fr');
        $user->setRoles(['ROLE_ADMIN', 'ROLE_USER']);
        $user->setPassword($plainPassword);
        $user->setIsAdmin(true);
        $user->setIsVerified(true);
        $user->setAgreeTermsServiceMember(true);
        $hashedPassword = $this->userPasswordHasher->hashPassword($user, $plainPassword);

        $validate = $this->validator->validate($user, null, ['registration']);
        if (count($validate) > 0) {
            throw new \Exception((string) $validate);
        }

        $user->setPassword($hashedPassword);
        $manager->persist($user);

        $userList = [];

        for ($i = 0; $i <= 10; $i++) {
            $user = new User();
            $user->setEmail($faker->email());
            $user->setRoles(['ROLE_USER']);
            $user->setPassword($plainPassword);
            $user->setIsAdmin(false);
            $user->setIsVerified(true);
            $user->setAgreeTermsServiceMember(true);
            $hashedPassword = $this->userPasswordHasher->hashPassword($user, $plainPassword);
            $validate = $this->validator->validate($user, null, ['registration']);
            if (count($validate) > 0) {
                throw new \Exception((string) $validate);
            }
            $user->setPassword($hashedPassword);
            $manager->persist($user);
            $userList[] = $user;
        }
        $manager->flush();


        // COMPANIES

        // first we create companies with easy membereshipCode, so we can test it smoothly
        // for ($i = 1; $i < 10; $i++) {
        //     $company = new Company();
        //     $rand = mt_rand(1, 20);
        //     $city = $faker->city();
        //     $company->setMembershipCode((string) $i . $i . $i . $i);
        //     $company->setCompanyStatus($faker->companySuffix());
        //     $company->setSiren($faker->siren());
        //     $company->setNaf($faker->regexify('[A-Z]{5}[0-4]{3}'));
        //     $company->setCompanyName($faker->company());
        //     $company->setAddress2($faker->streetAddress());
        //     $company->setAddress3($city);
        //     $company->setZipcode($faker->postcode());
        //     $company->setCity($city);
        //     $company->setBuildingConventionOutside77(false);
        //     $company->setAgreeOptionalWorker(false);
        //     $manager->persist($company);
        // }
        // $manager->flush();


        // $companyList = [];
        // for ($i = 0; $i < 20; $i++) {
        //     $company = new Company();
        //     $rand = mt_rand(1, 20);
        //     $city = $faker->city();
        //     $company->setMembershipCode($faker->unique->numberBetween(20100, 20250));
        //     $company->setMembershipCategory($this->companyHelper->getCorrectMembershipCategory($company, $rand));
        //     $company->setLaborUnion(mt_rand(0, 1) === 1 ? $capeb : $none);
        //     $company->setCompanyStatus($faker->companySuffix());
        //     $company->setSiren($faker->siren());
        //     $company->setNaf($faker->regexify('[A-Z]{5}[0-4]{3}'));
        //     $company->setCompanyName($faker->company());
        //     $company->setAddress2($faker->streetAddress());
        //     $company->setAddress3($city);
        //     $company->setZipcode($faker->postcode());
        //     $company->setCity($city);
        //     $company->setRepresentativeLastname($faker->lastName());
        //     $company->setRepresentativeFirstname($faker->firstName());
        //     $company->setRepresentativeFunction($faker->jobTitle());
        //     $company->setRepresentativePhone($faker->mobileNumber());
        //     $company->setWorkForce($rand <= 10 ? 'upTo10' : 'moreThan10');
        //     $company->setBuildingConventionOutside77($faker->boolean());
        //     $company->setAgreeOptionalWorker($faker->boolean());
        //     $company->setUser($userList[mt_rand(0, 9)]);
        //     $company->setClaimDate();
        //     $manager->persist($company);
        //     $companyList[] = $company;
        // }
        // $manager->flush();

        // DECLARATIONS
        // for each company
        // for ($i = 0; $i < 20; $i++) {
        //     // foreach month since january (we're in june ^^ )
        //     for ($j = 1; $j <= 6; $j++) {
        //         $rand = mt_rand(1, 20);

        //         $salaryExecutive = Money::EUR($faker->numberBetween(1000000, 4000000));
        //         $salaryEtam = Money::EUR($faker->numberBetween(600000, 3500000));
        //         $salaryWorker = Money::EUR($faker->numberBetween(3100000, 8700000));
        //         $workForce = $rand;

        //         $model = new DeclarationFormModel();
        //         $model->inputedDate = $this->declarationHelper->convertMonthAndYearToTimestamp($i, 2023);
        //         $model->salaryExecutive = $salaryExecutive;
        //         $model->salaryEtam = $salaryEtam;
        //         $model->salaryWorker = $salaryWorker;
        //         $model->feeExecutive = $this->moneyHelper->computeFeeAmount($salaryExecutive);
        //         $model->feeEtam = $this->moneyHelper->computeFeeAmount($salaryEtam);
        //         $model->feeWorker = $this->moneyHelper->computeFeeAmount($salaryWorker);
        //         $model->workForce = $workForce;
        //         $model->agreeOptionalWorker = $rand > 10;
        //         $model->agreeChangeMembershipCategory = false;
        //         $model->membershipCategory = $this->companyHelper->getCorrectMembershipCategory($companyList[$i], $workForce); // next membership category
        //         if ($companyList[$i]->getMembershipCategory() !== $model->membershipCategory) {
        //             $model->agreeChangeMembershipCategory = true;
        //         }
        //         $this->moneyHelper->computeDeclarationTvas($model);
        //         $this->moneyHelper->computeTotal($model);


        //         $dec = new Declaration();
        //         $dec->setInputedDate($this->declarationHelper->convertMonthAndYearToTimestamp($i, 2023));
        //         $dec->setSalaryWorker($model->salaryWorker);
        //         $dec->setSalaryEtam($model->salaryEtam);
        //         $dec->setSalaryExecutive($model->salaryExecutive);
        //         $dec->setFeeWorker($model->feeWorker);
        //         $dec->setFeeEtam($model->feeEtam);
        //         $dec->setFeeExecutive($model->feeExecutive);
        //         $dec->setTvaWorker($model->tvaWorker);
        //         $dec->setTvaEtam($model->tvaEtam);
        //         $dec->setTvaExecutive($model->tvaExecutive);
        //         $dec->setFeeAmount($model->feeAmount);
        //         $dec->setWorkForce($rand);
        //         $dec->setPriceCurrency('EUR');
        //         $dec->setAgreeOptionalWorker($rand > 10);
        //         $dec->setCompany($companyList[$i]);
        //         $dec->setMembershipCategory($model->membershipCategory);
        //         $dec->setCreationDate();
        //         $dec->setLastUpdateDate();
        //         $manager->persist($dec);
        //         $pdfData = $this->billService->generatePdfBill($dec);
        //         $this->billService->createBill($dec, $pdfData);
        //     }
        // }
        $manager->flush();
    }
}
