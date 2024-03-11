#include<iostream>
using namespace std;
int main(){
	int algosia[18], bajtek[18], asum=0,bsum=0, acyf[10],bcyf[10];
	for(int i=0;i<18;i++){
		cin>>algosia[i];
		asum+=algosia[i];
		switch(algosia[i]){
			case 10:
				acyf[9]++;
				break;
			case 9:
				acyf[8]++;
				break;
			case 8:
				acyf[7]++;
				break;
			case 7:
				acyf[6]++;
				break;
			case 6:
				acyf[5]++;
				break;
			case 5:
				acyf[4]++;
				break;
			case 4:
				acyf[3]++;
				break;
			case 3:
				acyf[2]++;
				break;
			case 2:
				acyf[1]++;
				break;
			case 1:
				acyf[0]++;
				break;
		}
	}
	for(int i=0;i<18;i++){
		cin>>bajtek[i];
		bsum+=bajtek[i];
		switch(algosia[i]){
			case 10:
				bcyf[9]++;
				break;
			case 9:
				bcyf[8]++;
				break;
			case 8:
				bcyf[7]++;
				break;
			case 7:
				bcyf[6]++;
				break;
			case 6:
				bcyf[5]++;
				break;
			case 5:
				bcyf[4]++;
				break;
			case 4:
				bcyf[3]++;
				break;
			case 3:
				bcyf[2]++;
				break;
			case 2:
				bcyf[1]++;
				break;
			case 1:
				bcyf[0]++;
				break;
		}
	}
	if(asum>bsum){
		cout<"algosia";
	}
	else if(asum<bsum){
		cout<<"bajtek";
	}
	else{
		for(int i=0;i<10;i++){
			if(acyf[i]>bcyf[i]){
				cout<<"algosia";
				return 0;
			}	
			else if(acyf[i]<bcyf[i]){
				cout<<"bajtek";
				return 0;
			}
		}
		cout<<"remis";
	}
	
}
