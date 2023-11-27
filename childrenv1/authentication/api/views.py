from rest_framework import generics, permissions, views, status
from rest_framework.response import Response
from rest_framework_simplejwt.tokens import RefreshToken
from rest_framework_simplejwt.views import TokenObtainPairView
from rest_framework_simplejwt.serializers import TokenObtainPairSerializer
from rest_framework_simplejwt.tokens import RefreshToken
from django.contrib.auth import authenticate
from rest_framework.views import APIView
from .serializers import  UserSerializer,RegisterSerializer

from django.contrib.auth import get_user_model

User=get_user_model()


class RegisterAPIView(APIView):
    serilizer_class = RegisterSerializer

    def post(self,request):
        data=request.data
        serializer = self.serilizer_class(data=data)
        if not serializer.is_valid():
            return Response({
                'status':False,
                'message':'Provide valid details to register'
            },status=status.HTTP_400_BAD_REQUEST)
        first_name = data.get('first_name')
        last_name=data.get('last_name')
        email = data.get('email')
        password = data.get('password')

        user = User.objects.filter(email=email)
        if user.exists():
            return Response({
                'status':False,
                'message':'User with this email already exists'
            },status=status.HTTP_400_BAD_REQUEST)
        user = User.objects.create(username=email,first_name=first_name,last_name=last_name,email=email)
        user.set_password(password)
        user.save()
        serializer = UserSerializer(user)
        return Response({
            'status':True,
            'message':'Registration successful',
            'data':serializer.data
        },status=status.HTTP_201_CREATED)



class RegisterUserView(APIView):
    queryset =  User.objects.all()
    serializer_class =  UserSerializer
    permission_classes = (permissions.AllowAny,)


    def perform_create(self, serializer):
        is_admin = self.request.data.get('is_admin', False)
        serializer.save(is_admin=is_admin)


class GetTokenView(TokenObtainPairView):
    serializer_class = TokenObtainPairSerializer


class LoginView(views.APIView):
    permission_classes = (permissions.AllowAny,)

    def post(self, request):
        email = request.data.get('email')
        password = request.data.get('password')

        print(email)
        print(password)

        # Perform authentication
        user = authenticate(email=email, password=password)
          

        if user is None:
            return Response({'error': 'Invalid email or password'}, status=status.HTTP_401_UNAUTHORIZED)

        # Authentication succeeded
        refresh = RefreshToken.for_user(user)
        access_token = str(refresh.access_token)
        refresh_token = str(refresh)
        data = {
            'message': 'Login successful',
            'access_token': access_token,
            'refresh_token': refresh_token,
            'user': UserSerializer(user).data
        }

        return Response(data, status=status.HTTP_200_OK)
    

class GetUserView(views.APIView):
    def get(self, request):
        try:
            users =  User.objects.all()
            serializer  = UserSerializer(users, many=True)
            return Response({
                "status": True,
                "data": serializer.data
            })
        except Exception as e:
             
            return Response({
                'status': False,
                'message': 'user found'
            })
        

class EditUserAPIView(APIView):
    def put(self, request, pk):
        try:
            getuser = User.objects.get(pk=pk)
            serializer = UserSerializer(getuser, data=request.data)
            if not serializer.is_valid():
                return Response({"status": "error","data": serializer.errors}, status=status.HTTP_400_BAD_REQUEST) 
            serializer.save()
     
            return Response({
                'status': True,
                'message':'Update Has been successful.',
                'data': serializer.data
            })


        except Exception as e:
                return Response({
                'status':False,
                'message':'We were not able to get registered users .',
                "error": str(e)
            })


 
